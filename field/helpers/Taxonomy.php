<?php

namespace ACFBuilder\Field\Helpers;

trait Taxonomy
{
    public $taxonomy;

    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }
}
