<?php

namespace JorenRothman\ACFBuilder\Fields\Basic;

use JorenRothman\ACFBuilder\Field;

class Text extends FieldBasic
{
    public string $placeholder = '';

    public string $prepend = '';

    public string $append = '';

    public string $maxlength = '';

    public bool $readonly = false;

    public bool $disabled = false;

    public function setType(): void
    {
        $this->type = 'text';
    }

    /**
     * Set placeholder for a field.
     *
     * @param string $value
     * @return static
     */
    public function setPlaceholder(string $value): static
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
    public function setPrepend(string $value): static
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
    public function setAppend(string $value): static
    {
        $this->append = $value;

        return $this;
    }

    /**
     * Set maxlength for a field.
     *
     * @param string $value
     * @return static
     */
    public function setMaxLength(string $value): static
    {
        $this->maxlength = $value;

        return $this;
    }

    /**
     * Set readonly for a field.
     *
     * @param bool $value
     * @return static
     */
    public function setReadOnly(bool $value): static
    {
        $this->readonly = $value;

        return $this;
    }

    /**
     * Set disabled for a field.
     *
     * @param bool $value
     * @return static
     */
    public function setDisabled(bool $value): static
    {
        $this->disabled = $value;

        return $this;
    }
}
