<?php

namespace ACFBuilder\Builders;

use ACFBuilder\Fields\Field;
use ACFBuilder\Util\Key;

class FieldGroup
{
    private $key;

    private $title;

    private $fields = [];

    private $location = [];

    private $menuOrder;

    private $position = 'normal';

    private $style = 'default';

    private $labelPlacement = 'top';

    private $instructionPlacement = 'label';

    private $hideOnScreen = '';

    public function __construct($title, $menuOrder = 0)
    {
        $this->title = $title;

        $this->menuOrder = $menuOrder;

        $this->setKey($title);
    }

    private function setKey($key)
    {
        $keyClass = new Key();

        $this->key = $keyClass->create('group', $key);
    }

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function setStyle($style)
    {
        $this->style = $style;
    }

    public function setLabelPlacement($labelPlacement)
    {
        $this->labelPlacement = $labelPlacement;
    }

    public function setInstructionsPlacement($instructionPlacement)
    {
        $this->instructionPlacement = $instructionPlacement;
    }

    public function setHideOnScreen($hideOnScreen)
    {
        $this->hideOnScreen = $hideOnScreen;
    }

    public function addField(Field $field)
    {
        $fieldName = $field->name;
        $fieldKey = $field->key;

        $field->setKey($this->key . '_' . $fieldKey);
        $field->setName($this->title . ' ' . $fieldName);

        array_push($this->fields, $field);
    }

    public function addLocation($location)
    {
        array_push($this->location, $location);
    }

    private function buildFields()
    {
        $fields = [];

        foreach ($this->fields as $field) {
            $fields[] = $field->build();
        }

        return $fields;
    }

    private function buildLocations()
    {
        $locations = [];

        foreach ($this->location as $location) {
            $locations[] = $location->build();
        }

        return $locations;
    }

    public function build()
    {
        $fields = $this->buildFields();
        $locations = $this->buildLocations();

        return [
            'key' => $this->key,
            'title' => $this->title,
            'fields' => $fields,
            'location' => $locations,
            'menu_order' => $this->menuOrder,
            'position' => $this->position,
            'style' => $this->style,
            'label_placement' => $this->labelPlacement,
            'instruction_placement' => $this->instructionPlacement,
            'hide_on_screen' => $this->hideOnScreen,
        ];
    }

    public function register()
    {
        if (function_exists('acf_add_local_field_group')) {
            $fieldGroup = $this->build();

            acf_add_local_field_group($fieldGroup);
        }
    }
}
