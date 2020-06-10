<?php

namespace ACFBuilder\Builders;

use ACFBuilder\Util\Key;

class FlexibleLayout
{
    public $key;

    public $name;

    public $label;

    public $display = 'block';

    public $subFields = [];

    public function __construct($label)
    {
        $this->label = $label;

        $this->setKey($label);
        $this->setName($label);
    }

    public function setKey($label)
    {
        $keyClass = new Key();

        $this->key = $keyClass->create('field', $label);
    }

    public function setName($label)
    {
        $keyClass = new Key();

        $this->name = $keyClass->create('', $label);
    }

    public function addSubField($field)
    {
        array_push($this->subFields, $field);
    }

    public function build()
    {
        $array = json_decode(json_encode($this), true);

        $convertedArray = [];

        foreach ($array as $key => $value) {
            $key = $this->fromCamelCase($key);

            $convertedArray[$key] = $value;
        }

        return $convertedArray;
    }

    private function fromCamelCase($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}
