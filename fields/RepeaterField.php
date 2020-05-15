<?php

namespace ACFBuilder\Fields;

class RepeaterField extends Field
{
    public $collapsed = '';

    public $min = 0;

    public $max = 0;

    public $layout = 'block';

    public $buttonLabel = 'Add Row';

    public $subFields = [];

    public function setType()
    {
        $this->type = 'repeater';
    }

    public function addSubField($field)
    {
        array_push($this->subFields, $field);
    }
}
