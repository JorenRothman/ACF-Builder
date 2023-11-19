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
     * options: array, url
     *
     * @param string $return_format
     * @return void
     */
    public function setReturnFormat(string $return_format): self
    {
        $this->return_format = $return_format;

        return $this;
    }
}
