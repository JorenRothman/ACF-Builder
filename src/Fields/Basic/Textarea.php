<?php

namespace Joren\ACFBuilder\Fields\Basic;

use Joren\ACFBuilder\Field;

class Textarea extends FieldBasic
{
    public string $placeholder = '';

    public string $maxlength = '';

    public int $rows;

    public string $new_lines = '';

    public function setType(): void
    {
        $this->type = 'textarea';
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
     * Restricts the number of rows and height.
     *
     * @param int $value
     * @return Field
     */
    public function setRows(int $value): self
    {
        $this->rows = $value;

        return $this;
    }

    /**
     * Decides how to render new lines.
     * options: 'wpautop' (Automatically add paragraphs), 'br' (Automatically add <br>) or '' (No Formatting) 
     *
     * @param string $value
     * @return Field
     */
    public function setNewLines(string $value): self
    {
        $this->new_lines = $value;

        return $this;
    }
}
