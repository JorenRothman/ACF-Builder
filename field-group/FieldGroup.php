<?php

namespace ACFBuilder\FieldGroup;

use ACFBuilder\IsBuildable;
use ACFBuilder\Util\ArrayUtil;
use ACFBuilder\Util\ObjectUtil;
use ACFBuilder\Util\StringUtil;

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
     * Prefix field name with field group name
     *
     * @var boolean
     */
    public $prefixFieldName = true;

    /**
     * Array of Field's
     *
     * @var Field[]
     */
    public $fields = [];

    /**
     * Array of FieldGroupLocation's
     *
     * @var FieldGroupLocation[]
     */
    public $location = [];

    /**
     * Menu order
     *
     * @var int;
     */
    public $menuOrder = 0;

    /**
     * position of group
     *
     * @var string
     */
    public $position = FieldGroupPosition::NORMAL;

    /**
     * Display style
     *
     * @var string
     */
    public $style = FieldGroupStyle::STANDARD;

    /**
     * Field label placement
     *
     * @var string
     */
    public $labelPlacement = FieldGroupLabelPlacement::TOP;

    /**
     * Instruction placement
     *
     * @var string
     */
    public $instructionPlacement = FieldGroupInstructionPlacement::LABEL;

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
    public $active = true;

    /**
     * The description
     *
     * @var string
     */
    public $description = '';

    /**
     * Create a new field group
     *
     * @param string $title field group title
     * @param boolean $prefixFields prefix field with field group name
     */
    public function __construct($title, $prefixFieldName = true)
    {
        $this->title = $title;
        $this->prefixFieldName = $prefixFieldName;

        $this->setKey();
    }

    private function setKey()
    {
        $this->key = StringUtil::snake($this->title);
    }

    /**
     * Add field to field array
     *
     * @param Field $field
     * @return void
     */
    public function addField($field)
    {
        $field->fieldOnAdd($this->title, $this->prefixFieldName);

        $this->fields[] = $field;
    }

    /**
     * Set field group position
     *
     * @param string $position
     * @return void
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Set field group label placement
     *
     * @param string $labelPlacement
     * @return void
     */
    public function setLabelPlacement($labelPlacement)
    {
        $this->labelPlacement = $labelPlacement;
    }

    /**
     * Set field group style
     *
     * @param string $style
     * @return void
     */
    public function setStyle($style)
    {
        $this->style = $style;
    }

    /**
     * Set field group instruction placement
     *
     * @param string $instructionPlacement
     * @return void
     */
    public function setInstructionPlacement($instructionPlacement)
    {
        $this->instructionPlacement = $instructionPlacement;
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

    public function setHideOnScreen($hideOnScreen)
    {
        $this->hideOnScreen = $hideOnScreen;
    }

    public function buildFields()
    {
        $fields = [];

        foreach ($this->fields as $field) {
            $fields[] = $field->build();
        }

        return $fields;
    }

    public function buildLocations()
    {
        $locations = [];

        foreach ($this->location as $location) {
            $locations[] = $location->build();
        }

        return $locations;
    }

    public function buildHideOnScreen()
    {
        if (is_null($this->hideOnScreen)) {
            return [];
        }

        return $this->hideOnScreen->build();
    }

    /**
     * Build the field group
     *
     * @return array
     */
    public function build()
    {
        $array = ObjectUtil::toArray($this);

        $array['fields'] = $this->buildFields();
        $array['location'] = $this->buildLocations();
        $array['hideOnScreen'] = $this->buildHideOnScreen();

        return ArrayUtil::snakeCase($array);
    }

    public function register()
    {
        $fieldGroup = $this->build();

        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group($fieldGroup);
        }
    }
}
