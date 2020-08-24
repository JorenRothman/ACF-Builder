<?php

namespace ACFBuilder\Field\Relational;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\AddTerm;
use ACFBuilder\Field\Helpers\AllowNull;
use ACFBuilder\Field\Helpers\FieldType;
use ACFBuilder\Field\Helpers\LoadTerms;
use ACFBuilder\Field\Helpers\Multiple;
use ACFBuilder\Field\Helpers\SaveTerm;
use ACFBuilder\Field\Helpers\Taxonomy as HelpersTaxonomy;

class Taxonomy extends Field
{
    use AllowNull;
    use Multiple;
    use HelpersTaxonomy;
    use FieldType;
    use AddTerm;
    use SaveTerm;
    use LoadTerms;

    public function setType()
    {
        $this->type = 'taxonomy';
    }
}
