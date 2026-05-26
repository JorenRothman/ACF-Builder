<?php

namespace JorenRothman\ACFBuilder\Fields\Relational;

class Link extends RelationalField
{
    public string $return_format = 'array';

    public function setType(): void
    {
        $this->type = 'link';
    }

    /**
     * Set the return format.
     *
     * @param 'array'|'url' $return_format
     * @return self
     */
    public function setReturnFormat(string $return_format): self
    {
        $this->return_format = $return_format;

        return $this;
    }
}
