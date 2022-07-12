<?php

namespace Joren\ACFBuilder\Fields\Choice;

use Joren\ACFBuilder\Field;

abstract class ChoiceField extends Field
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
