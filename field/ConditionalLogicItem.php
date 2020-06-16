<?php

namespace ACFBuilder\Field;

use ACFBuilder\IsBuildable;

class ConditionalLogicItem implements IsBuildable
{

    /**
     * The field key
     *
     * @var string
     */
    public $fieldKey;

    /**
     * Comparison operator
     *
     * @var string
     */
    public $operator;

    /**
     * Value to compare
     *
     * @var string
     */
    public $value;

    /**
     * Create conditional type
     *
     * @param Field $field
     * @param string $operator
     * @param string $value
     */
    public function __construct($field, $operator, $value)
    {
        $this->fieldKey = $field->key;
        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * Build conditional type
     *
     * @return array
     */
    public function build()
    {
        if (is_bool($this->value)) {
            $this->value = (string) intval($this->value);
        }

        return [
            'field' => $this->fieldKey,
            'operator' => $this->operator,
            'value' => $this->value,
        ];
    }
}
