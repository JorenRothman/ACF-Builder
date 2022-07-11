<?php

namespace Joren\ACFBuilder\Fields\Content;

use Joren\ACFBuilder\Field;

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
     * @return Field
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
     * @return Field
     */
    public function setHeight(string $value): self
    {
        $this->height = $value;

        return $this;
    }
}
