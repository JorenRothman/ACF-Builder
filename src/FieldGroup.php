<?php

namespace Joren\ACFBuilder;

use Joren\ACFBuilder\Util\StringUtil;

class FieldGroup
{
    public string $title;

    public string $name;

    public string $key;

    public function __construct(string $title, ?string $name = null, ?string $key = null)
    {
        $this->title = $title;
        $this->name = StringUtil::nameFormat($name ?? $title);

        $this->setKey($key ?? $this->name);
    }

    public function setKey(string $value): self
    {
        $this->key = md5($value);

        return $this;
    }

    public function build(): array
    {
        return json_decode(json_encode($this), true);
    }
}
