<?php

namespace ACFBuilder\Fields;

use ACFBuilder\IsBuildable;
use ACFBuilder\Util\Key;

abstract class Field implements IsBuildable
{
    public $key;

    public $label;

    public $name;

    public $type;

    public $prefix;

    public $instructions;

    public $required = false;

    public $conditionalLogic = [];

    public $wrapper = [];

    public $defaultValue;

    public $placeholder;

    public $prepend;

    public $append;

    public $maxlength;

    public $readonly = false;

    public $disabled = false;


    public function __construct($label)
    {
        $this->label = $label;

        $this->setKey($label);
        $this->setName($label);

        $this->setType();
    }

    private function setKey($key)
    {
        $keyClass = new Key();

        $this->key = $keyClass->create('field', $key);
    }

    private function setName($name)
    {
        $name = explode(' ', strtolower($name));

        $name = join('_', $name);

        $this->name = $name;
    }

    abstract public function setType();

    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    public function setInstructions($instructions)
    {
        $this->instructions = $instructions;
    }

    public function setRequired($required)
    {
        $this->required = $required;
    }

    public function setConditionalLogic($fieldRuleGroup)
    {
        array_push($this->conditionalLogic, $fieldRuleGroup->build(''));
    }

    public function setWrapper($width = 100, $class = '', $id = '')
    {
        $this->wrapper = [
            'width' => $width,
            'class' => $class,
            'id' => $id
        ];
    }

    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }

    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    public function setPrepend($prepend)
    {
        $this->prepend = $prepend;
    }

    public function setAppend($append)
    {
        $this->append = $append;
    }

    public function setMaxlength($maxlength)
    {
        $this->maxlength = (string) $maxlength;
    }

    public function setReadonly($readonly)
    {
        $this->readonly = $readonly;
    }

    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }

    public function build($suffix)
    {
        $keyClass = new Key();

        $array = json_decode(json_encode($this), true);
        $newArray = [];

        foreach ($array as $key => $value) {
            $newKey = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $key));

            $newArray[$newKey] = $value;



            if ($key === 'key') {
                $value = $suffix . ' ' . $value;

                $value = explode(' ', strtolower($value));

                $value = join('_', $value);

                $newArray[$newKey] = $value;
            }

            if ($key === 'name') {
                $name = $keyClass->create($suffix, $value);

                $newArray['name'] = $name;
            }

            if (is_bool($value)) {
                $newArray[$newKey] = intval($value);
            }
        }

        return $newArray;
    }
}
