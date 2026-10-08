<?php

use JorenRothman\ACFBuilder\FieldGroup;
use JorenRothman\ACFBuilder\Fields\Basic\Text;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleContent;
use JorenRothman\ACFBuilder\Fields\Layout\FlexibleLayout;
use JorenRothman\ACFBuilder\Fields\Layout\Group;
use JorenRothman\ACFBuilder\Fields\Layout\Repeater;
use JorenRothman\ACFBuilder\Migration\KeyResolver;
use PHPUnit\Framework\TestCase;

final class KeyResolverTest extends TestCase
{
    private function resolver(): KeyResolver
    {
        $fieldGroup = new FieldGroup('Page');

        $fieldGroup->addField(
            Text::make('Title'),
            Text::make('Title Link'),
            Group::make('CTA')->addSubField(Text::make('Title')),
            Repeater::make('Links')->addSubField(Text::make('Title')),
            FlexibleContent::make('Blocks')
                ->addLayout(FlexibleLayout::make('Hero')->addSubField(Text::make('Title')))
                ->addLayout(FlexibleLayout::make('Items')->addSubField(
                    Repeater::make('Rows')->addSubField(Text::make('Title'))
                )),
        );

        return new KeyResolver($fieldGroup->build()['fields']);
    }

    private function noValue(): callable
    {
        return fn(string $name) => null;
    }

    public function testTopLevelField()
    {
        $this->assertEquals('field_page_title', $this->resolver()->resolve('page_title', $this->noValue()));
    }

    public function testLongestNameWins()
    {
        $this->assertEquals('field_page_title_link', $this->resolver()->resolve('page_title_link', $this->noValue()));
    }

    public function testGroupSubField()
    {
        $this->assertEquals('field_page_cta_title', $this->resolver()->resolve('page_cta_title', $this->noValue()));
    }

    public function testRepeaterRow()
    {
        $resolver = $this->resolver();

        $this->assertEquals('field_page_links', $resolver->resolve('page_links', $this->noValue()));
        $this->assertEquals('field_page_links_title', $resolver->resolve('page_links_3_title', $this->noValue()));
    }

    public function testFlexibleContentUsesStoredLayout()
    {
        $layouts = fn(string $name) => $name === 'page_blocks' ? serialize(['hero', 'items']) : null;
        $resolver = $this->resolver();

        $this->assertEquals('field_page_blocks', $resolver->resolve('page_blocks', $layouts));
        $this->assertEquals('field_page_blocks_hero_title', $resolver->resolve('page_blocks_0_title', $layouts));
        $this->assertEquals('field_page_blocks_items_rows_title', $resolver->resolve('page_blocks_1_rows_2_title', $layouts));
    }

    public function testFlexibleContentWithoutStoredLayoutIsUnresolved()
    {
        $this->assertNull($this->resolver()->resolve('page_blocks_0_title', $this->noValue()));
    }

    public function testUnknownNameIsUnresolved()
    {
        $resolver = $this->resolver();

        $this->assertNull($resolver->resolve('other_title', $this->noValue()));
        $this->assertNull($resolver->resolve('page_cta_subtitle', $this->noValue()));
    }
}
