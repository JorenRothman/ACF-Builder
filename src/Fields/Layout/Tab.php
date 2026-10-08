<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;

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
     *
     * @param 'top'|'left' $placement
     * @return static
     */
    public function setPlacement(string $placement): static
    {
        $this->placement = $placement;

        return $this;
    }

    /**
     * Set the endpoint of the tab
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
