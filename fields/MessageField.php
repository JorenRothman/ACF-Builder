<?php

namespace ACFBuilder\Fields;

class MessageField extends Field
{
    public $message;

    public function __construct($label, $message)
    {
        parent::__construct($label);

        $this->message = $message;
    }

    public function setType()
    {
        $this->type = 'message';
    }
}
