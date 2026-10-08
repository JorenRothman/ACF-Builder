<?php

use JorenRothman\ACFBuilder\Migration\KeyMigration;
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

    public array $queries = [];

    public function esc_like(string $text): string
    {
        return addcslashes($text, '_%\\');
    }

    public function prepare(string $query, ...$args): string
    {
        return vsprintf(str_replace('%s', "'%s'", $query), $args);
    }

    public function query(string $query): int
    {
        $this->queries[] = $query;

        return 1;
    }
}

final class KeyMigrationTest extends TestCase
{
    public function testRunUpdatesEveryStore()
    {
        $wpdb = new FakeWpdb();

        $affected = (new KeyMigration($wpdb))->run(['field_old' => 'field_new']);

        $this->assertCount(6, $wpdb->queries);
        $this->assertEquals(6, $affected);

        foreach (['wp_postmeta', 'wp_termmeta', 'wp_usermeta', 'wp_commentmeta', 'wp_options', 'wp_posts'] as $i => $table) {
            $this->assertStringStartsWith("UPDATE {$table} SET", $wpdb->queries[$i]);
            $this->assertStringContainsString('field_new', $wpdb->queries[$i]);
            $this->assertStringContainsString('field_old', $wpdb->queries[$i]);
        }

        $this->assertStringContainsString('"field_old"', $wpdb->queries[5]);
    }

    public function testDryRunOnlySelects()
    {
        $wpdb = new FakeWpdb();

        (new KeyMigration($wpdb))->run(['field_old' => 'field_new'], true);

        foreach ($wpdb->queries as $query) {
            $this->assertStringStartsWith('SELECT', $query);
        }
    }

    public function testChainedMapThrows()
    {
        $this->expectException(LogicException::class);

        (new KeyMigration(new FakeWpdb()))->run(['field_a' => 'field_b', 'field_b' => 'field_c']);
    }
}
