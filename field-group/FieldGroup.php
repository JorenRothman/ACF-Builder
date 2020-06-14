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
    public $location = [array(
        array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'post',
        ),
    ),];

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
    public $position = 'normal';

    /**
     * Display style
     *
     * @var string
     */
    public $style = 'default';

    /**
     * Field label placement
     *
     * @var string
     */
    public $labelPlacement = 'top';

    /**
     * Instruction placement
     *
     * @var string
     */
    public $instructionPlacement = 'label';

    /**
     * Items to hide on screen
     *
     * @var FieldGroupHideOnScreen
     */
    public $hideOnScreen = [];

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
     */
    public function __construct($title)
    {
        $this->title = $title;

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

    public function buildFields()
    {
        $fields = [];

        foreach ($this->fields as $field) {
            $fields[] = $field->build($this->title);
        }

        return $fields;
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

        return ArrayUtil::snakeCase($array);
    }

    public function register()
    {
        $fieldGroup = $this->build();

        var_dump($fieldGroup);

        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group($fieldGroup);
        }
    }
}
