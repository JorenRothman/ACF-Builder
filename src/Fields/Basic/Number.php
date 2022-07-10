<?php

namespace Joren\ACFBuilder\Fields\Basic;

use Joren\ACFBuilder\Field;

class Number extends Field
{
    public string $placeholder = '';

    public string $prepend = '';

    public string $append = '';

    public int $min;

    public int $max;

    public int $step;

    public function setType(): void
    {
        $this->type = 'number';
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
     * Set Minimum number value.
     * 
     * @param int $value
     * @return Field
     */
    public function setMin(int $value): self
    {
        $this->min = $value;

        return $this;
    }

    /**
     * Set maximum number value.
     *
     * @param int $value
     * @return Field
     */
    public function setMax(int $value): self
    {
        $this->max = $value;

        return $this;
    }

    /**
     * Set step size increments.
     *
     * @param int $value
     * @return Field
     */
    public function setStep(int $value): self
    {
        $this->step = $value;

        return $this;
    }
}
