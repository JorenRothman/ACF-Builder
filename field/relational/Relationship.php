<?php

namespace ACFBuilder\Field\Relational;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\Elements;
use ACFBuilder\Field\Helpers\Filters;
use ACFBuilder\Field\Helpers\Max;
use ACFBuilder\Field\Helpers\Min;
use ACFBuilder\Field\Helpers\PostType;
use ACFBuilder\Field\Helpers\ReturnFormat;
use ACFBuilder\Field\Helpers\Taxonomy;

class Relationship extends Field
{
    use Min;
    use Max;
    use ReturnFormat;
    use Taxonomy;
    use PostType;
    use Filters;
    use Elements;

    public function setType()
    {
        $this->type = 'relationship';
    }
}
