<?php

namespace ACFBuilder\Field\Helpers;

trait SubFields
{
    public $subFields = [];

    public function addSubField($subField)
    {
        $this->subFields[] = $subField;
    }

    public function build()
    {
        $this->subFields = array_map(function ($subField) {
            $subField->fieldOnAdd($subField->name);

            return $subField->build();
        }, $this->subFields);

        return parent::build();
    }
}
