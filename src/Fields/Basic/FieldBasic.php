<?php

namespace JorenRothman\ACFBuilder\Fields\Basic;

use JorenRothman\ACFBuilder\Field;

abstract class FieldBasic extends Field
{
    public mixed $default_value = '';

    /**
     * A default value used by ACF if no value has yet been saved
     * 
     * @param mixed $value 
     * @return Field 
     */
    public function setDefaultValue(mixed $value): self
    {
        $this->default_value = $value;

        return $this;
    }
}
