<?php

namespace ACFBuilder\Field\Content;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Library;
use ACFBuilder\Field\Helpers\MaxHeight;
use ACFBuilder\Field\Helpers\MaxSize;
use ACFBuilder\Field\Helpers\MaxWidth;
use ACFBuilder\Field\Helpers\MimeTypes;
use ACFBuilder\Field\Helpers\MinHeight;
use ACFBuilder\Field\Helpers\MinSize;
use ACFBuilder\Field\Helpers\MinWidth;
use ACFBuilder\Field\Helpers\PreviewSize;
use ACFBuilder\Field\Helpers\ReturnFormat;

class Image extends Field
{
    use ReturnFormat;
    use PreviewSize;
    use Library;
    use MinWidth;
    use MinHeight;
    use MinSize;
    use MaxWidth;
    use MaxHeight;
    use MaxSize;
    use MimeTypes;

    public function setType()
    {
        $this->type = 'image';
    }
}
