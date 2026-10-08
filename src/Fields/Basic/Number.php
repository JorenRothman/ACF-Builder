<?php

namespace JorenRothman\ACFBuilder\Fields\Basic;

use JorenRothman\ACFBuilder\Field;

class Number extends FieldBasic
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
     * Set Minimum number value.
     *
     * @param int $value
     * @return static
     */
    public function setMin(int $value): static
    {
        $this->min = $value;

        return $this;
    }

    /**
     * Set maximum number value.
     *
     * @param int $value
     * @return static
     */
    public function setMax(int $value): static
    {
        $this->max = $value;

        return $this;
    }

    /**
     * Set step size increments.
     *
     * @param int $value
     * @return static
     */
    public function setStep(int $value): static
    {
        $this->step = $value;

        return $this;
    }
}
