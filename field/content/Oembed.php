<?php

namespace ACFBuilder\Field\Content;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Height;
use ACFBuilder\Field\Helpers\Width;

class Oembed extends Field
{
    use Width;
    use Height;

    public function setType()
    {
        $this->type = 'oembed';
    }
}
