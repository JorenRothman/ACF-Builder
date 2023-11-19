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
     * @return self 
     */
    public function setTaxonomy(string $taxonomy): self
    {
        $this->taxonomy = $taxonomy;

        return $this;
    }

    /**
     * Set the field type.
     * options: checkbox, multi_select, select, radio
     * 
     * @param string $field_type 
     * @return self 
     */
    public function setFieldType(string $field_type): self
    {
        $this->field_type = $field_type;

        return $this;
    }

    /**
     * Set the add term state.
     * 
     * @param bool $add_term 
     * @return self 
     */
    public function setAddTerm(bool $add_term): self
    {
        $this->add_term = $add_term;

        return $this;
    }

    /**
     * Set the save terms state.
     * 
     * @param bool $save_terms 
     * @return self 
     */
    public function setSaveTerms(bool $save_terms): self
    {
        $this->save_terms = $save_terms;

        return $this;
    }

    /**
     * Set the load terms state.
     * 
     * @param bool $load_terms 
     * @return self 
     */
    public function setLoadTerms(bool $load_terms): self
    {
        $this->load_terms = $load_terms;

        return $this;
    }

    /**
     * Set the return format.
     * options: id, object
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
}
