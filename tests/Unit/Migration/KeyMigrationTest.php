<?php

use JorenRothman\ACFBuilder\FieldGroup;
use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleContent;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleLayout;
use JorenRothman\ACFBuilder\Migration\KeyMigration;
use JorenRothman\ACFBuilder\Migration\KeyResolver;
use PHPUnit\Framework\TestCase;

final class FakeWpdb
{
    public string $prefix = 'wp_';
    public string $postmeta = 'wp_postmeta';
    public string $termmeta = 'wp_termmeta';
    public string $usermeta = 'wp_usermeta';
    public string $commentmeta = 'wp_commentmeta';
    public string $options = 'wp_options';
    public string $posts = 'wp_posts';

    /** @var array<string, array<int, object>> References per table, as returned by get_results(). */
    public array $references = [];

    /** @var array<string, mixed> Stored values by name. */
    public array $values = [];

    public array $queries = [];

    public array $updates = [];

    public function esc_like(string $text): string
    {
        return addcslashes($text, '_%\\');
    }

    public function prepare(string $query, ...$args): string
    {
        return vsprintf(str_replace('%s', "'%s'", $query), $args);
    }

    public function get_results(string $query): array
    {
        preg_match('/FROM (\w+)/', $query, $matches);

        return $this->references[$matches[1]] ?? [];
    }

    public function get_var(string $query): mixed
    {
        preg_match("/= '([^']*)' LIMIT 1$/", $query, $matches);

        return $this->values[$matches[1]] ?? null;
    }

    public function update(string $table, array $data, array $where): int
    {
        $this->updates[] = [$table, $data, $where];

        return 1;
    }

    public function query(string $query): int
    {
        $this->queries[] = $query;

        return 0;
    }
}

final class KeyMigrationTest extends TestCase
{
    private function resolver(): KeyResolver
    {
        $fieldGroup = new FieldGroup('Page');

        $fieldGroup->addField(
            Text::make('Title'),
            FlexibleContent::make('Blocks')->addLayout(
                FlexibleLayout::make('Hero')->addSubField(Text::make('Title'))
            ),
        );

        return new KeyResolver($fieldGroup->build()['fields']);
    }

    private function row(int $id, string $name, string $value, int $objectId = 1): object
    {
        return (object) ['id' => $id, 'object_id' => $objectId, 'name' => $name, 'value' => $value];
    }

    public function testResolvesReferencesByName()
    {
        $wpdb = new FakeWpdb();
        $wpdb->values['page_blocks'] = serialize(['hero']);
        $wpdb->references['wp_postmeta'] = [
            $this->row(1, '_page_title', 'field_page_field_title'),
            $this->row(2, '_page_blocks', 'field__field_page_field_blocks'),
            $this->row(3, '_page_blocks_0_title', 'field_layout_hero_field_title'),
        ];

        $affected = (new KeyMigration($wpdb))->run($this->resolver(), []);

        $this->assertEquals(3, $affected);
        $this->assertEquals([
            ['wp_postmeta', ['meta_value' => 'field_page_title'], ['meta_id' => 1]],
            ['wp_postmeta', ['meta_value' => 'field_page_blocks'], ['meta_id' => 2]],
            ['wp_postmeta', ['meta_value' => 'field_page_blocks_hero_title'], ['meta_id' => 3]],
        ], $wpdb->updates);
    }

    public function testResolvesOptionsUnderAnyPrefix()
    {
        $wpdb = new FakeWpdb();
        $wpdb->references['wp_options'] = [
            $this->row(1, '_options_page_title', 'field_page_field_title'),
            $this->row(2, '_theme_settings_page_title', 'field_page_field_title'),
        ];

        (new KeyMigration($wpdb))->run($this->resolver(), []);

        $this->assertEquals([
            ['wp_options', ['option_value' => 'field_page_title'], ['option_id' => 1]],
            ['wp_options', ['option_value' => 'field_page_title'], ['option_id' => 2]],
        ], $wpdb->updates);
    }

    public function testFallsBackToMapAndSkipsTheRest()
    {
        $wpdb = new FakeWpdb();
        $wpdb->references['wp_termmeta'] = [
            $this->row(1, '_renamed', 'field_old'),
            $this->row(2, '_removed', 'field_gone'),
            $this->row(3, '_page_title', 'field_page_title'),
        ];

        $migration = new KeyMigration($wpdb);
        $affected = $migration->run($this->resolver(), ['field_old' => 'field_new']);

        $this->assertEquals(1, $affected);
        $this->assertEquals(1, $migration->getSkipped());
        $this->assertEquals([['wp_termmeta', ['meta_value' => 'field_new'], ['meta_id' => 1]]], $wpdb->updates);
    }

    public function testDryRunChangesNothing()
    {
        $wpdb = new FakeWpdb();
        $wpdb->references['wp_postmeta'] = [$this->row(1, '_page_title', 'field_page_field_title')];

        $affected = (new KeyMigration($wpdb))->run($this->resolver(), ['field_old' => 'field_new'], true);

        $this->assertEquals(1, $affected);
        $this->assertEquals([], $wpdb->updates);

        foreach ($wpdb->queries as $query) {
            $this->assertStringStartsWith('SELECT', $query);
        }
    }

    public function testBlocksUseTheMap()
    {
        $wpdb = new FakeWpdb();

        (new KeyMigration($wpdb))->run($this->resolver(), ['field_old' => 'field_new']);

        $this->assertCount(1, $wpdb->queries);
        $this->assertStringStartsWith('UPDATE wp_posts SET', $wpdb->queries[0]);
        $this->assertStringContainsString('"field_old"', $wpdb->queries[0]);
        $this->assertStringContainsString('"field_new"', $wpdb->queries[0]);
    }

    public function testChainedMapThrows()
    {
        $this->expectException(LogicException::class);

        (new KeyMigration(new FakeWpdb()))->run($this->resolver(), ['field_a' => 'field_b', 'field_b' => 'field_c']);
    }
}
