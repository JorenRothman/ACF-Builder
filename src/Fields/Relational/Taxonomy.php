<?php

namespace JorenRothman\ACFBuilder\Fields\Relational;

class Taxonomy extends RelationalField
{
    public string $taxonomy = 'category';

    public string $field_type = 'checkbox';

    public bool $add_term = true;

    public bool $save_terms = false;

    public bool $load_terms = false;

    public string $return_format = 'object';

    public bool $multiple = false;

    public bool $allow_null = false;

    protected function setType(): void
    {
        $this->type = 'taxonomy';
    }

    /**
     * Set the taxonomy.
     * 
     * @param string $taxonomy 
     * @return static 
     */
    public function setTaxonomy(string $taxonomy): static
    {
        $this->taxonomy = $taxonomy;

        return $this;
    }

    /**
     * Set the field type.
     *
     * @param 'checkbox'|'multi_select'|'select'|'radio' $field_type
     * @return static
     */
    public function setFieldType(string $field_type): static
    {
        $this->field_type = $field_type;

        return $this;
    }

    /**
     * Set the add term state.
     * 
     * @param bool $add_term 
     * @return static 
     */
    public function setAddTerm(bool $add_term): static
    {
        $this->add_term = $add_term;

        return $this;
    }

    /**
     * Set the save terms state.
     * 
     * @param bool $save_terms 
     * @return static 
     */
    public function setSaveTerms(bool $save_terms): static
    {
        $this->save_terms = $save_terms;

        return $this;
    }

    /**
     * Set the load terms state.
     * 
     * @param bool $load_terms 
     * @return static 
     */
    public function setLoadTerms(bool $load_terms): static
    {
        $this->load_terms = $load_terms;

        return $this;
    }

    /**
     * Set the return format.
     *
     * @param 'id'|'object' $return_format
     * @return static
     */
    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

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
}
