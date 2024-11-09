<?php

namespace JorenRothman\ACFBuilder\Fields\Choice;

use JorenRothman\ACFBuilder\Field;

abstract class ChoiceField extends Field
{
    public mixed $default_value = '';

    /**
     * A default value used by ACF if no value has yet been saved
     *
     * @param mixed $value
     * @return static
     */
    public function setDefaultValue(mixed $value): self
    {
        $this->default_value = $value;

        return $this;
    }
}
