<?php

namespace ACFBuilder\Fields;

class RadioField extends Field
{
    public $choices = [];

    public $otherChoice = false;

    public $saveOtherChoice = false;

    public $layout = false;

    public function setType()
    {
        $this->type = 'radio';
    }

    public function setChoices($choices)
    {
        $this->choices = $choices;
    }

    public function setOtherChoice($otherChoice)
    {
        $this->otherChoice = $otherChoice;
    }

    public function setSaveOtherChoice($saveOtherChoice)
    {
        $this->saveOtherChoice = $saveOtherChoice;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
