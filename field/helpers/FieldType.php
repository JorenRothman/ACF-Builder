<?php

namespace ACFBuilder\Field\Helpers;

trait FieldType
{
    public $fieldType;

    public function setFieldType($fieldType)
    {
        $this->fieldType = $fieldType;
    }
}
