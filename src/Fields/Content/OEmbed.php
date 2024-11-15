<?php

namespace JorenRothman\ACFBuilder\Fields\Content;

use JorenRothman\ACFBuilder\Field;

class OEmbed extends FieldContent
{
    public string $width = '';

    public string $height = '';

    public function setType(): void
    {
        $this->type = 'oembed';
    }

    /**
     * Specify the width of the embed.
     *
     * @param string $value
     * @return static
     */
    public function setWidth(string $value): self
    {
        $this->width = $value;

        return $this;
    }

    /**
     * Specify the height of the embed.
     *
     * @param string $value
     * @return static
     */
    public function setHeight(string $value): self
    {
        $this->height = $value;

        return $this;
    }
}
