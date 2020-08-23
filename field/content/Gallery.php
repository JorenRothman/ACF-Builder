<?php

namespace ACFBuilder\Field\Content;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Insert;
use ACFBuilder\Field\Helpers\Library;
use ACFBuilder\Field\Helpers\Max;
use ACFBuilder\Field\Helpers\MaxHeight;
use ACFBuilder\Field\Helpers\MaxSize;
use ACFBuilder\Field\Helpers\MaxWidth;
use ACFBuilder\Field\Helpers\MimeTypes;
use ACFBuilder\Field\Helpers\Min;
use ACFBuilder\Field\Helpers\MinHeight;
use ACFBuilder\Field\Helpers\MinSize;
use ACFBuilder\Field\Helpers\MinWidth;
use ACFBuilder\Field\Helpers\PreviewSize;
use ACFBuilder\Field\Helpers\ReturnFormat;

class Gallery extends Field
{
    use Min;
    use Max;
    use ReturnFormat;
    use PreviewSize;
    use Library;
    use MinWidth;
    use MinHeight;
    use MaxWidth;
    use MaxHeight;
    use MinSize;
    use MaxSize;
    use MimeTypes;
    use Insert;

    public function setType()
    {
        $this->type = 'gallery';
    }
}
