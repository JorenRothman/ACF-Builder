<?php

namespace JorenRothman\ACFBuilder\Fields\Basic;

use JorenRothman\ACFBuilder\Field;

class URL extends FieldBasic
{
    public string $placeholder = '';

    public function setType(): void
    {
        $this->type = 'url';
    }

    /**
     * Set placeholder for a field.
     *
     * @param string $value
     * @return Field
     */
    public function setPlaceholder(string $value): self
    {
        $this->placeholder = $value;

        return $this;
    }
}
