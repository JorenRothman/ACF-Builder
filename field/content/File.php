<?php

namespace ACFBuilder\Field\Content;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Library;
use ACFBuilder\Field\Helpers\MaxSize;
use ACFBuilder\Field\Helpers\MimeTypes;
use ACFBuilder\Field\Helpers\MinSize;
use ACFBuilder\Field\Helpers\ReturnFormat;

class File extends Field
{
    use ReturnFormat;
    use Library;
    use MinSize;
    use MaxSize;
    use MimeTypes;

    public function setType()
    {
        $this->type = 'file';
    }
}
