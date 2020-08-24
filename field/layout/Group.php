<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Layout;
use ACFBuilder\Field\Helpers\SubFields;

class Group extends Field
{
    use Layout;
    use SubFields;

    public function setType()
    {
        $this->type = 'group';
    }
}
