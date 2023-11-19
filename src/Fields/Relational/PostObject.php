<?php

namespace JorenRothman\ACFBuilder\Fields\Relational;

class PostObject extends RelationalField
{
    public array $post_type = [];

    public array $taxonomy = [];

    public bool $allow_null = false;

    public bool $multiple = false;

    public string $return_format = 'object';

    public bool $ui = true;

    public function setType(): void
    {
        $this->type = 'post_object';
    }

    /**
     * Add a post type.
     * 
     * @param string $post_type 
     * @return self 
     */
    public function addPostType(string $post_type): self
    {
        $this->post_type[] = $post_type;

        return $this;
    }

    /**
     * Add a taxonomy.
     * 
     * @param string $taxonomy 
     * @return self 
     */
    public function addTaxonomy(string $taxonomy): self
    {
        $this->taxonomy[] = $taxonomy;

        return $this;
    }

    /**
     * Set the allow null state.
     * 
     * @param bool $allow_null 
     * @return self 
     */
    public function setAllowNull(bool $allow_null): self
    {
        $this->allow_null = $allow_null;

        return $this;
    }

    /**
     * Set the multiple state.
     * 
     * @param bool $multiple 
     * @return self 
     */
    public function setMultiple(bool $multiple): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Set the return format.
     * options: object, array
     * 
     * @param string $return_format 
     * @return self 
     */
    public function setReturnFormat(string $return_format): self
    {
        $this->return_format = $return_format;

        return $this;
    }

    /**
     * Set the UI state.
     * 
     * @param bool $ui 
     * @return self 
     */
    public function setUI(bool $ui): self
    {
        $this->ui = $ui;

        return $this;
    }
}
