<?php

namespace ACFBuilder\Fields;

class SelectField extends Field
{
    public $choices = [];

    public $allowNull = 0;

    public $multiple = 0;

    public $ui = 0;

    public $ajax = 0;

    public function setType()
    {
        $this->type = 'select';
    }

    public function setChoices($choices)
    {
        $this->choices = $choices;
    }

    public function setAllowNull($allow)
    {
        $this->allowNull = intval($allow);
    }

    public function setMultiple($multiple)
    {
        $this->multiple = intval($multiple);
    }

    public function setUI($ui)
    {
        $this->ui = $ui;
    }

    public function setAjax($ajax)
    {
        $this->ajax = $ajax;
    }
}
