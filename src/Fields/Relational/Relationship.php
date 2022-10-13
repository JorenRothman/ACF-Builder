<?php

namespace Joren\ACFBuilder\Fields\Relational;

class Relationship extends RelationalField
{
    public array $post_type = [];

    public array $taxonomy = [];

    public array $filters = [];

    public array $elements = [];

    public int $min = 0;

    public int $max = 0;

    public string $return_format = 'object';

    public function setType(): void
    {
        $this->type = 'relationship';
    }

    /**
     * Add a post type.
     * 
     * @param string $post_type,... 
     * @return self 
     */
    public function addPostType(string ...$post_type): self
    {
        $this->post_type = $post_type;

        return $this;
    }

    /**
     * Add a taxonomy.
     * 
     * @param string $taxonomy,... 
     * @return self 
     */
    public function addTaxonomy(string ...$taxonomy): self
    {
        $this->taxonomy = $taxonomy;

        return $this;
    }


    /**
     * Add a filter.
     * 
     * @param bool $search
     * @param bool $taxonomy
     * @param bool $post_type
     * @return self 
     */
    public function addFilter(bool $search, bool $taxonomy = false, bool $postType = false): self
    {
        $search && $this->filters[] = 'search';
        $taxonomy && $this->filters[] = 'taxonomy';
        $postType && $this->filters[] = 'post_type';

        return $this;
    }

    /**
     * Add an element.
     * options: featured_image
     * 
     * @param string $element,... 
     * @return self 
     */
    public function addElement(string ...$element): self
    {
        $this->elements = $element;

        return $this;
    }

    /**
     * Set the minimum number of posts.
     * 
     * @param int $min 
     * @return self 
     */
    public function setMin(int $min): self
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Set the maximum number of posts.
     * 
     * @param int $max 
     * @return self 
     */
    public function setMax(int $max): self
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Set the return format.
     * options: object, id
     * 
     * @param string $return_format 
     * @return self 
     */
    public function setReturnFormat(string $return_format): self
    {
        $this->return_format = $return_format;

        return $this;
    }
}
