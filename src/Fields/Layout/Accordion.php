<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;

class Accordion extends Field
{
    public bool $open = false;

    public bool $multi_expand = false;

    public bool $endpoint = false;

    public function setType(): void
    {
        $this->type = 'accordion';
    }

    /**
     * Set the open state of the accordion
     *
     * @param bool $open
     * @return static
     */
    public function setOpen(bool $open): static
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Set the multi expand state of the accordion
     *
     * @param bool $multi_expand
     * @return static
     */
    public function setMultiExpand(bool $multi_expand): static
    {
        $this->multi_expand = $multi_expand;

        return $this;
    }

    /**
     * Set the endpoint state of the accordion
     *
     * @param bool $endpoint
     * @return static
     */
    public function setEndpoint(bool $endpoint): static
    {
        $this->endpoint = $endpoint;

        return $this;
    }
}
