<?php

namespace ACFBuilder\Field\Relational;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\AllowNull;
use ACFBuilder\Field\Helpers\Multiple;
use ACFBuilder\Field\Helpers\PostType;
use ACFBuilder\Field\Helpers\ReturnFormat;
use ACFBuilder\Field\Helpers\Taxonomy;
use ACFBuilder\Field\Helpers\UI;

class PostObject extends Field
{
    use ReturnFormat;
    use UI;
    use AllowNull;
    use Multiple;
    use Taxonomy;
    use PostType;

    public function setType()
    {
        $this->type = 'post_object';
    }
}
