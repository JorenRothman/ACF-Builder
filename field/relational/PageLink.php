<?php

namespace ACFBuilder\Field\Relational;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\AllowArchives;
use ACFBuilder\Field\Helpers\AllowNull;
use ACFBuilder\Field\Helpers\Multiple;
use ACFBuilder\Field\Helpers\PostType;
use ACFBuilder\Field\Helpers\Taxonomy;

class PageLink extends Field
{
    use AllowNull;
    use Multiple;
    use Taxonomy;
    use PostType;
    use AllowArchives;

    public function setType()
    {
        $this->type = 'page_link';
    }
}
