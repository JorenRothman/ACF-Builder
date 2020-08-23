<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Layouts;

class FlexibleContent extends Field
{
    use Layouts;

    public function setType()
    {
        $this->type = 'flexible_content';
    }
}
