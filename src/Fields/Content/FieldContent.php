<?php

namespace Joren\ACFBuilder\Fields\Content;

use Joren\ACFBuilder\Field;

abstract class FieldContent extends Field
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
