<?php

namespace Joren\ACFBuilder;

use Joren\ACFBuilder\Util\StringUtil;

abstract class Field
{
    public string $key;

    public string $label;

    public string $name;

    public string $type;

    public string $instructions;

    public bool $required = false;

    public mixed $conditional_logic = false;

    public array $wrapper = ['width' => '', 'class' => '', 'id' => ''];

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        $this->label = $label;
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
    public function setKey(string $value): self
    {
        $this->key = md5($value);

        return $this;
    }

    abstract protected function setType(): void;

    public function setInstructions(string $value): self
    {
        $this->instructions = $value;

        return $this;
    }

    public function setRequired(bool $value): self
    {
        $this->required = $value;

        return $this;
    }

    public function setConditionalLogic(mixed $value): self
    {
        $this->conditional_logic = $value;

        return $this;
    }

    public function setWrapper(array $value): self
    {
        $this->wrapper = $value;

        return $this;
    }
}
