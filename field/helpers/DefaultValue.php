<?php

namespace ACFBuilder\Field\Helpers;

trait DefaultValue
{
    public $defaultValue;

    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
    }
}
