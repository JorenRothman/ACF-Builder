<?php

use JorenRothman\ACFBuilder\FieldConditionalLogic;
use JorenRothman\ACFBuilder\FieldGroup;
use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Choice\TrueFalse;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleContent;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleLayout;
use JorenRothman\ACFBuilder\Fields\Layout\Group;
use JorenRothman\ACFBuilder\Fields\Layout\Repeater;
use JorenRothman\ACFBuilder\Fields\Relational\Relationship;
use JorenRothman\ACFBuilder\KeyStrategy;
use PHPUnit\Framework\TestCase;

final class KeyStrategyTest extends TestCase
{
    protected function tearDown(): void
    {
        KeyStrategy::setDefault(KeyStrategy::PATH);
    }

    private function pathGroup(string $title): FieldGroup
    {
        return (new FieldGroup($title))->setKeyStrategy(KeyStrategy::PATH);
    }

    public function testPathIsDefault()
    {
        $result = (new FieldGroup('Hero'))->addField(new Text('Title'))->build();

        $this->assertEquals('field_hero_title', $result['fields'][0]['key']);
    }

    public function testLegacyOptOut()
    {
        $result = (new FieldGroup('Hero'))
            ->setKeyStrategy(KeyStrategy::LEGACY)
            ->addField(new Text('Title'))
            ->build();

        $this->assertEquals('field_hero_field_title', $result['fields'][0]['key']);
    }

    public function testLegacyBuildMatches3xOutput()
    {
        $toggle = TrueFalse::make('Toggle');
        $title = Text::make('Title');
        $sibling = Text::make('Sibling')
            ->setConditionalLogic((new FieldConditionalLogic)->and($title, '!=', ''));

        $fieldGroup = (new FieldGroup('Page Settings'))
            ->setKeyStrategy(KeyStrategy::LEGACY)
            ->addField(
                $toggle,
                Group::make('CTA', null, 'my-cta')->addSubField(
                    Text::make('Label'),
                    Repeater::make('Items')->addSubField($title, $sibling)->setCollapsed($title)
                ),
                FlexibleContent::make('Blocks')->addLayout(
                    FlexibleLayout::make('Hero')->addSubField(
                        Text::make('Heading'),
                        Group::make('Inner')->addSubField(Text::make('X'))
                    )
                )
            );

        $this->assertJsonStringEqualsJsonFile(
            __DIR__ . '/../fixtures/legacy-build.json',
            json_encode($fieldGroup->build())
        );
    }

    public function testTopLevelFieldKey()
    {
        $result = $this->pathGroup('Hero')->addField(new Text('Title'))->build();

        $this->assertEquals('field_hero_title', $result['fields'][0]['key']);
        $this->assertEquals('hero_title', $result['fields'][0]['name']);
    }

    public function testCustomKeyIsUsedAsPathSegment()
    {
        $result = $this->pathGroup('Hero')->addField(new Text('Title', null, 'custom'))->build();

        $this->assertEquals('field_hero_custom', $result['fields'][0]['key']);
    }

    public function testNestedGroupAndRepeaterKeys()
    {
        $result = $this->pathGroup('Hero')->addField(
            (new Group('CTA'))->addSubField(
                (new Repeater('Items'))->addSubField(new Text('Title'))
            )
        )->build();

        $group = $result['fields'][0];
        $repeater = $group['sub_fields'][0];

        $this->assertEquals('field_hero_cta', $group['key']);
        $this->assertEquals('field_hero_cta_items', $repeater['key']);
        $this->assertEquals('field_hero_cta_items_title', $repeater['sub_fields'][0]['key']);
        $this->assertEquals('title', $repeater['sub_fields'][0]['name']);
    }

    public function testFlexibleContentKeys()
    {
        $result = $this->pathGroup('Page')->addField(
            (new FlexibleContent('Blocks'))->addLayout((new FlexibleLayout('Hero'))->addSubField(new Text('Title')))
        )->build();

        $layouts = $result['fields'][0]['layouts'];

        $this->assertEquals(['layout_page_blocks_hero'], array_keys($layouts));
        $this->assertEquals('layout_page_blocks_hero', $layouts['layout_page_blocks_hero']['key']);
        $this->assertEquals('field_page_blocks_hero_title', $layouts['layout_page_blocks_hero']['sub_fields'][0]['key']);
    }

    public function testRepeaterCollapsedUsesPathKey()
    {
        $title = new Text('Title');
        $repeater = (new Repeater('Items'))->addSubField($title)->setCollapsed($title);

        $result = $this->pathGroup('Hero')->addField($repeater)->build();

        $this->assertEquals('field_hero_items_title', $result['fields'][0]['collapsed']);
    }

    public function testConditionalLogicUsesPathKey()
    {
        $toggle = new TrueFalse('Show CTA');
        $title = (new Text('Title'))
            ->setConditionalLogic((new FieldConditionalLogic)->and($toggle, '==', true));

        $result = $this->pathGroup('Hero')->addField($toggle, (new Group('CTA'))->addSubField($title))->build();

        $this->assertEquals(
            'field_hero_show_cta',
            $result['fields'][1]['sub_fields'][0]['conditional_logic'][0][0]['field']
        );
    }

    public function testDuplicateKeysThrow()
    {
        $fieldGroup = $this->pathGroup('Hero')->addField(new Text('Title'), new Text('title'));

        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('field_hero_title');

        $fieldGroup->build();
    }

    public function testPathCollisionAcrossLevelsThrows()
    {
        $fieldGroup = $this->pathGroup('Hero')->addField(
            (new Group('CTA'))->addSubField(new Text('Title')),
            new Text('CTA Title')
        );

        $this->expectException(LogicException::class);

        $fieldGroup->build();
    }

    public function testDefaultKeyStrategy()
    {
        FieldGroup::setDefaultKeyStrategy(KeyStrategy::LEGACY);

        $result = (new FieldGroup('Hero'))->addField(new Text('Title'))->build();

        $this->assertEquals('field_hero_field_title', $result['fields'][0]['key']);
    }

    public function testUnknownStrategyThrows()
    {
        $this->expectException(InvalidArgumentException::class);

        (new FieldGroup('Hero'))->setKeyStrategy('hash');
    }

    public function testMigrationMap()
    {
        $fieldGroup = (new FieldGroup('Page'))->addField(
            new Text('Title'),
            (new Group('CTA'))->addSubField(new Text('Label')),
            (new FlexibleContent('Blocks'))->addLayout((new FlexibleLayout('Hero'))->addSubField(new Text('Heading')))
        );

        $this->assertEquals([
            'field_page_field_title' => 'field_page_title',
            'field_page_field_cta' => 'field_page_cta',
            'field_field_page_field_cta_field_label' => 'field_page_cta_label',
            'field_page_field_blocks' => 'field_page_blocks',
            'field_layout_hero_field_heading' => 'field_page_blocks_hero_heading',
        ], $fieldGroup->migrationMap());
    }

    public function testFieldKeyPropertyMatchesBuiltKey()
    {
        $title = new Text('Title');
        $group = new Group('CTA');
        $fieldGroup = new FieldGroup('Hero');

        // Sub field added after its parent is attached, the key must still resolve through the tree.
        $fieldGroup->addField($group);
        $group->addSubField($title);

        $built = $fieldGroup->build()['fields'][0];

        $this->assertEquals('field_hero_cta_title', $title->key);
        $this->assertEquals($built['sub_fields'][0]['key'], $title->key);
        $this->assertEquals($built['key'], $group->getKey());
    }

    public function testFieldKeyPropertyMatchesBuiltKeyInLegacy()
    {
        $title = new Text('Title');
        $fieldGroup = (new FieldGroup('Hero'))
            ->setKeyStrategy(KeyStrategy::LEGACY)
            ->addField((new Group('CTA'))->addSubField($title));

        $built = $fieldGroup->build()['fields'][0];

        $this->assertEquals('field_field_hero_field_cta_field_title', $title->key);
        $this->assertEquals($built['sub_fields'][0]['key'], $title->key);
    }

    public function testLayoutKeyPropertyMatchesBuiltKey()
    {
        $layout = new FlexibleLayout('Hero');
        $heading = new Text('Heading');
        $layout->addSubField($heading);

        $fieldGroup = (new FieldGroup('Page'))->addField((new FlexibleContent('Blocks'))->addLayout($layout));

        $this->assertEquals('layout_page_blocks_hero', $layout->key);
        $this->assertEquals('field_page_blocks_hero_heading', $heading->key);
        $this->assertArrayHasKey($layout->key, $fieldGroup->build()['fields'][0]['layouts']);
    }

    public function testBidirectionalTargetAcceptsField()
    {
        $relatedPosts = new Relationship('Related Posts');
        $relatedPages = new Relationship('Related Pages');

        (new FieldGroup('Page'))->addField($relatedPosts);
        $postGroup = (new FieldGroup('Post'))->addField(
            $relatedPages->setBidirectional(true)->setBidirectionalTarget($relatedPosts)->setBidirectionalTarget('field_custom')
        );

        $this->assertEquals(
            ['field_page_related_posts', 'field_custom'],
            $postGroup->build()['fields'][0]['bidirectional_target']
        );
    }
}
