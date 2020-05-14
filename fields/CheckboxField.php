<?php

namespace ACFBuilder\Fields;

class CheckboxField extends Field
{
    public $choices = [];

    public $layout = 'vertical';

    public $allowCustom = false;

    public $saveCustom = false;

    public $toggle = false;

    public $returnFormat = 'value';

    public $disabled = [];

    public function setType()
    {
        $this->type = 'checkbox';
    }

    public function setChoices($choices)
    {
        $this->choices = $choices;
    }

    /**
     * Choices 'vertical', 'horizontal'
     *
     * @param string $layout
     * @return void
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function setAllowCustom($allowCustom)
    {
        $this->allowCustom = $allowCustom;
    }

    public function setSaveCustom($saveCustom)
    {
        $this->saveCustom = $saveCustom;
    }

    public function setToggle($toggle)
    {
        $this->toggle = $toggle;
    }

    /**
     * Choices 'value', 'label', 'custom'
     *
     * @param string $returnFormat
     * @return void
     */
    public function setReturnFormat($returnFormat)
    {
        $this->returnFormat = $returnFormat;
    }

    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }
}
