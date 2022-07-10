<?php

namespace Joren\ACFBuilder\Fields\Basic;

use Joren\ACFBuilder\Field;

class Password extends Field
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
}
