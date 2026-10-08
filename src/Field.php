<?php

namespace JorenRothman\ACFBuilder;

use JorenRothman\ACFBuilder\Util\StringUtil;

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

    public static function make(string $label, ?string $name = null, ?string $key = null): static
    {
        return new static($label, $name, $key);
    }

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
     * @return static
     */
    protected function setKey(string $value): static
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

    /**
     * Set instruction for field
     *
     * @param string $value
     * @return static
     */
    public function setInstructions(string $value): static
    {
        $this->instructions = $value;

        return $this;
    }

    /**
     * Whether or not the field value is required.
     *
     * @param bool $value
     * @return static
     */
    public function setRequired(bool $value): static
    {
        $this->required = (int) $value;

        return $this;
    }

    /**
     * Conditionally hide or show this field based on other field's values.
     * Best to use the ACF UI and export to understand the array structure.
     *
     * @param FieldConditionalLogic $value
     * @return static
     */
    public function setConditionalLogic(FieldConditionalLogic $value): static
    {
        $this->conditional_logic = $value;

        return $this;
    }

    /**
     * An array of attributes given to the field element
     *
     * @param array $value
     * @return static
     */
    public function setWrapper(string $width, string $class = '', string $id = ''): static
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
     * Resolve the key this field gets when built under the given parent key.
     *
     * @param string $name
     * @return string
     */
    protected function resolveKey(string $name): string
    {
        return $name
            ? 'field_' . StringUtil::nameFormat($name . '_' . $this->key)
            : $this->key;
    }

    /**
     * Collect the built keys of this field and its descendants, indexed by object id.
     *
     * @param string $name
     * @return array<int, string>
     */
    public function collectKeys(string $name = ''): array
    {
        return [spl_object_id($this) => $this->resolveKey($name)];
    }

    /**
     * Build the field
     *
     * @param string $name
     * @param array<int, string> $keys Built keys of all fields in the tree, see collectKeys().
     * @return array
     */
    public function build(string $name = '', array $keys = []): array
    {
        $keys = $keys ?: $this->collectKeys($name);

        $data = json_decode(json_encode($this), true);
        $data['key'] = $this->resolveKey($name);

        if ($this->conditional_logic instanceof FieldConditionalLogic) {
            $data['conditional_logic'] = $this->conditional_logic->build($name, $keys);
        }

        return $data;
    }
}
