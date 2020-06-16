<?php

namespace ACFBuilder\Field;

use ACFBuilder\IsBuildable;

class FieldConditionalLogic implements IsBuildable
{
    /**
     * Conditional Logic Items
     *
     * @var ConditionalLogicItem[]
     */
    public $items = [];

    /**
     * Build all given conditional logic items
     *
     * @return array
     */
    public function build()
    {
        $items = [];

        foreach ($this->items as $item) {
            $items[] = $item->build();
        }

        return $items;
    }

    /**
     * Add a conditional logic item
     *
     * @param ConditionalLogicItem $item
     * @return void
     */
    public function addItem($item)
    {
        $this->items[] = $item;
    }
}
