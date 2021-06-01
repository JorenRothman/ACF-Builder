<?php

namespace ACFBuilder\Field\Helpers;

trait SubFields
{
    public $subFields = [];

    public function addSubField($subField)
    {
        $this->subFields[] = $subField;
    }
}
