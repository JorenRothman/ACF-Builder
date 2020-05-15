<?php

namespace ACFBuilder\Fields;

class PostObjectField extends Field
{
    public $postType = '';

    public $taxonomy = '';

    public $allowNull = 0;

    public $multiple = 0;

    public $returnFormat = 'object';

    public function setType()
    {
        $this->type = 'post_object';
    }

    /**
     * Undocumented function
     *
     * @param array $postTypes an array of post types slugs
     * @return void
     */
    public function setPostType($postTypes)
    {
        $this->postType = $postTypes;
    }

    public function setTaxonomy($taxonomies)
    {
        $this->taxonomy = $taxonomies;
    }

    public function setAllowNull($allowNull)
    {
        $this->allowNull = intval($allowNull);
    }

    public function setMultiple($multiple)
    {
        $this->multiple = intval($multiple);
    }

    public function setReturnFormat($returnFormat)
    {
        $this->returnFormat = $returnFormat;
    }
}
