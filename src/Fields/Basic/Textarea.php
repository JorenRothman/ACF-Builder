<?php

namespace JorenRothman\ACFBuilder\Fields\Basic;

use JorenRothman\ACFBuilder\Field;

class Textarea extends FieldBasic
{
    public string $placeholder = '';

    public string $maxlength = '';

    public int $rows;

    public string $new_lines = '';

    public bool $readonly = false;

    public bool $disabled = false;

    public function setType(): void
    {
        $this->type = 'textarea';
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
     * Restricts the number of rows and height.
     *
     * @param int $value
     * @return static
     */
    public function setRows(int $value): static
    {
        $this->rows = $value;

        return $this;
    }

    /**
     * Decides how to render new lines.
     *
     * @param 'wpautop'|'br'|'' $value
     * @return static
     */
    public function setNewLines(string $value): static
    {
        $this->new_lines = $value;

        return $this;
    }

    /**
     * Whether or not the field value is readonly.
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
     * Whether or not the field value is disabled.
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
