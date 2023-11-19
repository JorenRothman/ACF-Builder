<?php

namespace JorenRothman\ACFBuilder\Fields\Relational;

class PageLink extends RelationalField
{
    public array $post_type = [];

    public array $taxonomy = [];

    public bool $allow_null = false;

    public bool $allow_archives = false;

    public bool $multiple = false;

    protected function setType(): void
    {
        $this->type = 'page_link';
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
     * Set the allow archives state.
     * 
     * @param bool $allow_archives 
     * @return self 
     */
    public function setAllowArchives(bool $allow_archives): self
    {
        $this->allow_archives = $allow_archives;

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
}
