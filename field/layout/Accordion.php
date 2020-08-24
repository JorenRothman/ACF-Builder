<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Endpoint;
use ACFBuilder\Field\Helpers\MultiExpand;
use ACFBuilder\Field\Helpers\Open;

class Accordion extends Field
{
    use Endpoint;
    use Open;
    use MultiExpand;

    public function setType()
    {
        $this->type = 'accordion';
    }
}
