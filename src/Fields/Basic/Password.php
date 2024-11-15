<?php

namespace JorenRothman\ACFBuilder\Fields\Basic;

use JorenRothman\ACFBuilder\Field;

class Password extends FieldBasic
{
    public string $placeholder = '';

    public string $prepend = '';

    public string $append = '';

    public function setType(): void
    {
        $this->type = 'password';
    }

    /**
     * Set placeholder for a field.
     *
     * @param string $value
     * @return static
     */
    public function setPlaceholder(string $value): self
    {
        $this->placeholder = $value;

        return $this;
    }

    /**
     * Appears before the input.
     *
     * @param string $value
     * @return static
     */
    public function setPrepend(string $value): self
    {
        $this->prepend = $value;

        return $this;
    }

    /**
     * Appears after the input.
     *
     * @param string $value
     * @return static
     */
    public function setAppend(string $value): self
    {
        $this->append = $value;

        return $this;
    }
}
