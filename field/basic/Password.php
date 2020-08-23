<?php

namespace ACFBuilder\Field\Basic;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Append;
use ACFBuilder\Field\Helpers\Placeholder;
use ACFBuilder\Field\Helpers\Prepend;

class Password extends Field
{
    use Placeholder;
    use Prepend;
    use Append;

    protected function setType()
    {
        $this->type = 'password';
    }
}
