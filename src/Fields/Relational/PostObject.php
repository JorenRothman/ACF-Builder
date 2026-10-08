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

    public int $bidirectional = 0;

    public string|array $bidirectional_target = '';

    public function setType(): void
    {
        $this->type = 'post_object';
    }

    /**
     * Add a post type.
     *
     * @param string $post_type
     * @return static
     */
    public function addPostType(string $post_type): static
    {
        $this->post_type[] = $post_type;

        return $this;
    }

    /**
     * Add a taxonomy.
     *
     * @param string $taxonomy
     * @return static
     */
    public function addTaxonomy(string $taxonomy): static
    {
        $this->taxonomy[] = $taxonomy;

        return $this;
    }

    /**
     * Set the allow null state.
     *
     * @param bool $allow_null
     * @return static
     */
    public function setAllowNull(bool $allow_null): static
    {
        $this->allow_null = $allow_null;

        return $this;
    }

    /**
     * Set the multiple state.
     *
     * @param bool $multiple
     * @return static
     */
    public function setMultiple(bool $multiple): static
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Set the return format.
     *
     * @param 'object'|'id' $return_format
     * @return static
     */
    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

        return $this;
    }

    /**
     * Set the UI state.
     *
     * @param bool $ui
     * @return static
     */
    public function setUI(bool $ui): static
    {
        $this->ui = $ui;

        return $this;
    }

    public function setBidirectional(bool $bidirectional): static
    {
        $this->bidirectional = (int) $bidirectional;

        return $this;
    }

    /**
     * Set the bidirectional target.
     *
     *
     * @param string $field
     * @return static
     */
    public function setBidirectionalTarget(string $field): static
    {
        if ($this->bidirectional_target === '') {
            $this->bidirectional_target = [];
        }

        $this->bidirectional_target[] = $field;

        return $this;
    }
}
