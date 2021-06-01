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

    public function __construct($label, $name = null)
    {
        $this->label = $label;
        $this->name = $name;
    }

    public function onLayoutAdd($flexibleFieldName)
    {
        if (is_null($this->name)) {
            $this->name = StringUtil::snake($flexibleFieldName . ' ' . $this->label);
        } else {
            $this->name = StringUtil::snake($flexibleFieldName . ' ' . $this->name);
        }


        $this->key = StringUtil::hash($this->name);
    }

    public function addSubField($subField)
    {
        $subField->fieldOnAdd($this->label, false);

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
