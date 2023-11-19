<?php

namespace JorenRothman\ACFBuilder\Fields\Basic;

use JorenRothman\ACFBuilder\Field;

class Range extends FieldBasic
{
    public int $min = 0;

    public int $max = 100;

    public int $step = 0;

    public string $prepend = '';

    public string $append = '';

    public function setType(): void
    {
        $this->type = 'range';
    }

    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    public function setStep(int $step): self
    {
        $this->step = $step;

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
