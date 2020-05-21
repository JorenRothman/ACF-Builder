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
}
