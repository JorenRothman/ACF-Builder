<?php

namespace Joren\ACFBuilder\Fields\Basic;

use Joren\ACFBuilder\Field;

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
     * @return Field
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
     * @return Field
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
     * @return Field
     */
    public function setAppend(string $value): self
    {
        $this->append = $value;

        return $this;
    }

    /**
     * Set maxlength for a field.
     *
     * @param string $value
     * @return Field
     */
    public function setMaxLength(string $value): self
    {
        $this->maxlength = $value;

        return $this;
    }

    /**
     * Set readonly for a field.
     *
     * @param bool $value
     * @return Field
     */
    public function setReadOnly(bool $value): self
    {
        $this->readonly = $value;

        return $this;
    }

    /**
     * Set disabled for a field.
     *
     * @param bool $value
     * @return Field
     */
    public function setDisabled(bool $value): self
    {
        $this->disabled = $value;

        return $this;
    }
}
