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

    public function setKey($key)
    {
        $keyClass = new Key();

        $this->key = $keyClass->create('field', $key);
    }

    public function setName($name)
    {
        $name = str_replace('-', '', $name);

        $name = explode(' ', strtolower($name));

        $name = join('_', $name);

        $name = str_replace('__', '_', $name);

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
        array_push($this->conditionalLogic, $fieldRuleGroup);
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

    public function build()
    {
        $array = json_decode(json_encode($this), true);

        $array['conditionalLogic'] = [];

        foreach ($this->conditionalLogic as $conditionalLogic) {
            array_push($array['conditionalLogic'], $conditionalLogic->build());
        }

        $convertedArray = [];

        foreach ($array as $key => $value) {
            $key = $this->from_camel_case($key);

            $convertedArray[$key] = $value;
        }

        // var_dump($convertedArray['conditional_logic']);

        return $convertedArray;
    }

    public function from_camel_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}
