<?php

namespace ACFBuilder\Field\Basic;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Placeholder;

class URL extends Field
{
    use DefaultValue;
    use Placeholder;

    protected function setType()
    {
        $this->type = 'url';
    }
}
