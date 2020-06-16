<?php

namespace ACFBuilder\Field;

use ACFBuilder\IsBuildable;
use ACFBuilder\Util\ArrayUtil;
use ACFBuilder\Util\ObjectUtil;
use ACFBuilder\Util\StringUtil;

abstract class Field implements IsBuildable
{
    /**
     * The field key
     *
     * @var string
     */
    public $key;

    /**
     * The field label
     *
     * @var string
     */
    public $label;

    /**
     * The field name
     *
     * @var string
     */
    public $name;

    /**
     * The field type
     *
     * @var string
     */
    public $type;

    /**
     * The field instructions
     *
     * @var string
     */
    public $instructions = '';

    /**
     * Is field required
     *
     * @var boolean
     */
    public $required = false;

    /**
     * Conditional logic array
     *
     * @var FieldConditionalLogic[]
     */
    public $conditionalLogic = [];

    /**
     * The field wrapper
     *
     * @var array
     */
    public $wrapper = [
        'width' => '',
        'class' => '',
        'id' => ''
    ];

    public function __construct($label, $name = null)
    {
        $this->label = $label;

        if ($name !== null) {
            $this->name = StringUtil::snake($name);
        }

        $this->setType();
    }

    /**
     * Add conditional Logic 
     *
     * @param FieldConditionalLogic $fieldConditionalLogic
     * @return void
     */
    public function addConditionalLogic($fieldConditionalLogic)
    {
        $this->conditionalLogic[] = $fieldConditionalLogic;
    }

    /**
     * Build conditional logic
     *
     * @return array
     */
    private function buildConditionalLogic()
    {
        $conditionalLogics = [];

        foreach ($this->conditionalLogic as $conditionalLogic) {
            $conditionalLogics[] = $conditionalLogic->build();
        }

        return $conditionalLogics;
    }

    /**
     * Method when field is added to field group
     *
     * @param string $fieldGroupName
     * @return void
     */
    public function fieldOnAdd($fieldGroupName)
    {
        if ($this->name === null) {
            $this->name = StringUtil::snake($fieldGroupName . $this->label);
        }

        $this->key = StringUtil::snake($this->name);
    }

    /**
     * Add instructions to field
     *
     * @param string $instructions
     * @return void
     */
    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;
    }

    /**
     * Build the field
     *
     * @param string $fieldGroupName The field group name
     * @return array
     */
    public function build()
    {
        $array = ObjectUtil::toArray($this);

        $array['conditionalLogic'] = $this->buildConditionalLogic();

        return ArrayUtil::snakeCase($array);
    }

    abstract protected function setType();
}
