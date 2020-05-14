<?php

namespace ACFBuilder\Fields;

class NumberField extends Field
{
    public $min = '';

    public $max = '';

    public $step = '';

    public function setType()
    {
        $this->type = 'number';
    }

    public function setMin($min)
    {
        $this->min = (string) $min;
    }

    public function setMax($max)
    {
        $this->max = (string) $max;
    }

    public function setStep($step)
    {
        $this->step = (string) $step;
    }
}
