<?php

namespace ACFBuilder\FieldGroup;

use ACFBuilder\IsBuildable;

class FieldGroup implements IsBuildable
{
    /**
     * Field group key
     *
     * @var string
     */
    public $key;

    /**
     * The title
     *
     * @var string
     */
    public $title;

    /**
     * Array of Field's
     *
     * @var Field[]
     */
    public $fields;

    /**
     * Array of FieldGroupLocation's
     *
     * @var FieldGroupLocation[]
     */
    public $location;

    /**
     * Menu order
     *
     * @var int;
     */
    public $menuOrder;

    /**
     * position of group
     *
     * @var string
     */
    public $position;

    /**
     * Display style
     *
     * @var string
     */
    public $style;

    /**
     * Field label placement
     *
     * @var string
     */
    public $labelPlacement;

    /**
     * Instruction placement
     *
     * @var string
     */
    public $instructionPlacement;

    /**
     * Items to hide on screen
     *
     * @var FieldGroupHideOnScreen
     */
    public $hideOnScreen;

    /**
     * is active
     *
     * @var boolean
     */
    public $active;

    /**
     * The description
     *
     * @var string
     */
    public $description;

    /**
     * Create a new field group
     *
     * @param string $title field group title
     */
    public function __construct($title)
    {
        $this->title = $title;

        $this->setKey();
    }

    private function setKey()
    {
        $this->key = 'group_' . str_replace(' ', '_', $this->title);
    }

    /**
     * Add field to field array
     *
     * @param Field $field
     * @return void
     */
    public function addField($field)
    {
        $this->fields[] = $field;
    }

    /**
     * Add field group location to location array
     *
     * @param FieldGroupLocations $location
     * @return void
     */
    public function addLocation($location)
    {
        $this->location[] = $location;
    }

    /**
     * Build the field group
     *
     * @return array
     */
    public function build()
    {
        return [];
    }
}
