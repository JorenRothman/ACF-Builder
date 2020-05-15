<?php

namespace ACFBuilder\Fields;

class TaxonomyField extends Field
{
    public $taxonomy = 'category';

    public $fieldType = 'checkbox';

    public $allowNull = 0;

    public $loadSaveTerms = 0;

    public $returnFormat = 'id';

    public $addTerm = 1;

    public function setType()
    {
        $this->type = 'taxonomy';
    }

    public function setTaxonomy($taxonomy)
    {
        $this->taxonomy = $taxonomy;
    }

    /**
     * Choices of 'checkbox' (Checkbox inputs), 'multi_select' (Select field - multiple), 'radio' (Radio inputs) or 'select' (Select field)
     *
     * @param string $fieldType
     * @return void
     */
    public function setFieldType($fieldType)
    {
        $this->fieldType = $fieldType;
    }

    public function setAllowNull($allowNull)
    {
        $this->allowNull = intval($allowNull);
    }

    public function setLoadSaveTerms($loadSaveTerms)
    {
        $this->loadSaveTerms = intval($loadSaveTerms);
    }

    /**
     * Choices of 'object' (Term object) or 'id' (Term ID)
     *
     * @param string $returnFormat
     * @return void
     */
    public function setReturnFormat($returnFormat)
    {
        $this->returnFormat = $returnFormat;
    }

    public function setAddTerm($addTerm)
    {
        $this->addTerm = intval($addTerm);
    }
}
