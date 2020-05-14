<?php

namespace ACFBuilder\Fields;

class PasswordField extends Field
{
    public function setType()
    {
        $this->type = 'password';
    }
}
