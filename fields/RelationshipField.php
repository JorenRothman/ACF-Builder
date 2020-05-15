<?php

namespace ACFBuilder\Fields;

class RelationshipField extends Field
{
    public $postType = '';

    public $taxonomy = '';

    public $filters = ['search', 'post_type', 'taxonomy'];

    public $elements = [];

    public $min = 0;

    public $max = 0;

    public $returnFormat = 'object';

    public function setType()
    {
        $this->type = 'relationship';
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

    /**
     * Undocumented function
     *
     * @param array $taxonomies an array of taxonomy slugs
     * @return void
     */
    public function setTaxonomy($taxonomies)
    {
        $this->taxonomy = $taxonomies;
    }

    /**
     * Choices of 'search' (Search input), 'post_type' (Post type select) and 'taxonomy' (Taxonomy select)
     *
     * @param array $filters
     * @return void
     */
    public function setFilters($filters)
    {
        $this->filters = $filters;
    }

    /**
     * Choices of 'featured_image' (Featured image icon)
     *
     * @param array $elements
     * @return void
     */
    public function setElements($elements)
    {
        $this->elements = $elements;
    }

    public function setMin($min)
    {
        $this->min = intval($min);
    }

    public function setMax($max)
    {
        $this->max = intval($max);
    }

    /**
     * Choices of 'object' (Post object) or 'id' (Post ID)
     *
     * @param string $returnFormat
     * @return void
     */
    public function setReturnFormat($returnFormat)
    {
        $this->returnFormat = $returnFormat;
    }
}
