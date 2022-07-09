<?php

namespace Joren\ACFBuilder;

use Joren\ACFBuilder\Util\StringUtil;

class Field
{
    public $key;

    public $label;

    public $name;

    public $type;

    public $instructions;

    public $required;

    public $conditional_logic;

    public $wrapper;

    public function __construct(string $label, ?string $name = null, ?string $key = null)
    {
        $this->label = $label;
        $this->name = StringUtil::nameFormat($name ?? $label);

        $this->setKey($key ?? $this->name);
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
}
