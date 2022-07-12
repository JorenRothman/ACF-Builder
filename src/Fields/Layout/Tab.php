<?php

namespace Joren\ACFBuilder\Fields\Layout;

use Joren\ACFBuilder\Field;

class Tab extends Field
{
    public string $placement = 'top';

    public bool $endpoint = false;

    protected function setType(): void
    {
        $this->type = 'tab';
    }

    /**
     * Set the placement of the tab
     * options: top, bottom, left, right
     *
     * @param string $placement
     * @return self
     */
    public function setPlacement(string $placement): self
    {
        $this->placement = $placement;

        return $this;
    }

    /**
     * Set the endpoint of the tab
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
