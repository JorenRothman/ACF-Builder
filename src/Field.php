<?php

namespace Joren\ACFBuilder;

use Joren\ACFBuilder\Util\StringUtil;

abstract class Field
{
    public string $key;

    public string $label;

    public string $name;

    public string $type;

    public string $instructions = '';

    public int $required = 0;

    public mixed $conditional_logic = 0;

    public array $wrapper = ['width' => '', 'class' => '', 'id' => ''];

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        $this->label = ucwords($label);
        $this->name = StringUtil::nameFormat($name ?? $label);

        $this->setKey($key ?? $this->name);
        $this->setType();
    }

    /**
     * Set key for a field.
     *
     * @param string $value
     * @return Field
     */
    protected function setKey(string $value): self
    {
        $this->key = 'field_' . StringUtil::nameFormat($value);

        return $this;
    }


    /**
     * Set the type of the field.
     *
     * @return void
     */
    abstract protected function setType(): void;

    public function setInstructions(string $value): self
    {
        $this->instructions = $value;

        return $this;
    }

    /**
     * Whether or not the field value is required.
     * 
     * @param bool $value 
     * @return Field 
     */
    public function setRequired(bool $value): self
    {
        $this->required = (int) $value;

        return $this;
    }

    /**
     * Conditionally hide or show this field based on other field's values. 
     * Best to use the ACF UI and export to understand the array structure.
     * 
     * @param FieldConditionalLogic $value 
     * @return Field 
     */
    public function setConditionalLogic(FieldConditionalLogic $value): self
    {
        $this->conditional_logic = $value;

        return $this;
    }

    /**
     * An array of attributes given to the field element
     * 
     * @param array $value 
     * @return Field 
     */
    public function setWrapper(string $width, string $class = '', string $id = ''): self
    {
        $this->wrapper = ['width' => $width, 'class' => $class, 'id' => $id];

        return $this;
    }

    public function onAddToFieldGroup(FieldGroup $parent): void
    {
        $fieldGroupName = $parent->name;

        $this->name = $fieldGroupName . '_' . $this->name;
        $this->setKey($fieldGroupName . '_' . $this->key);
    }

    /**
     * Build the field
     *
     * @return array
     */
    public function build(string $name = '')
    {
        if ($name) {
            $this->setKey($name . '_' . $this->key);
        }

        return json_decode(json_encode($this), true);
    }
}
