<?php

namespace ACFBuilder\Field\Content;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\DefaultValue;
use ACFBuilder\Field\Helpers\Delay;
use ACFBuilder\Field\Helpers\MediaUpload;
use ACFBuilder\Field\Helpers\Tabs;

class Wysiwyg extends Field
{
    use DefaultValue;
    use Tabs;
    use MediaUpload;
    use Delay;

    public function setType()
    {
        $this->type = 'wysiwyg';
    }
}
