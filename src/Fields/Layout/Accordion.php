<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;

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
     * @return self
     */
    public function setOpen(bool $open): self
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Set the multi expand state of the accordion
     *
     * @param bool $multi_expand
     * @return self
     */
    public function setMultiExpand(bool $multi_expand): self
    {
        $this->multi_expand = $multi_expand;

        return $this;
    }

    /**
     * Set the endpoint state of the accordion
     *
     * @param bool $endpoint
     * @return self
     */
    public function setEndpoint(bool $endpoint): self
    {
        $this->endpoint = $endpoint;

        return $this;
    }
}
