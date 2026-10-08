<?php

use JorenRothman\ACFBuilder\FieldConditionalLogic;
use JorenRothman\ACFBuilder\FieldGroup;
use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Choice\TrueFalse;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleContent;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleLayout;
use JorenRothman\ACFBuilder\Fields\Layout\Group;
use JorenRothman\ACFBuilder\Fields\Layout\Repeater;
use JorenRothman\ACFBuilder\KeyStrategy;
use PHPUnit\Framework\TestCase;

final class KeyStrategyTest extends TestCase
{
    protected function tearDown(): void
    {
        FieldGroup::setDefaultKeyStrategy(KeyStrategy::LEGACY);
    }

    private function pathGroup(string $title): FieldGroup
    {
        return (new FieldGroup($title))->setKeyStrategy(KeyStrategy::PATH);
    }

    public function testLegacyIsDefault()
    {
        $result = (new FieldGroup('Hero'))->addField(new Text('Title'))->build();

        $this->assertEquals('field_hero_field_title', $result['fields'][0]['key']);
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
        FieldGroup::setDefaultKeyStrategy(KeyStrategy::PATH);

        $result = (new FieldGroup('Hero'))->addField(new Text('Title'))->build();

        $this->assertEquals('field_hero_title', $result['fields'][0]['key']);
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
}
