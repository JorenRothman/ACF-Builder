<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Endpoint;
use ACFBuilder\Field\Helpers\Placement;

class Tab extends Field
{
    use Placement;
    use Endpoint;

    public function setType()
    {
        $this->type = 'tab';
    }
}
