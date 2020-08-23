<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Min;
use ACFBuilder\Field\Helpers\SubFields;
use ACFBuilder\Util\StringUtil;

class FlexibleLayout
{
    public $key;

    public $name;

    public $label;

    public $display;

    public $subFields = [];

    public $min;

    public $max;

    public function __construct($label)
    {
        $this->label = $label;
    }

    public function onLayoutAdd($flexibleFieldName)
    {
        $this->name = StringUtil::snake($flexibleFieldName . ' ' . $this->label);

        $this->key = $this->name;
    }

    public function addSubField($subField)
    {
        $subField->fieldOnAdd($subField->name);

        $this->subFields[] = $subField;
    }

    public function build()
    {
        $this->subFields = array_map(function ($subField) {


            return $subField->build();
        }, $this->subFields);

        return $this;
    }
}
