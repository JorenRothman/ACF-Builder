<?php

namespace ACFBuilder\Field\Relational;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\AllowNull;
use ACFBuilder\Field\Helpers\Multiple;
use ACFBuilder\Field\Helpers\ReturnFormat;
use ACFBuilder\Field\Helpers\Role;

class User extends Field
{
    use ReturnFormat;
    use AllowNull;
    use Multiple;
    use Role;

    public function setType()
    {
        $this->type = 'user';
    }
}
