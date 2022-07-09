<?php

namespace Joren\ACFBuilder;

/**
 * Class FieldGroupLocations
 * 
 * @package Joren\ACFBuilder
 */
class FieldGroupLocations
{
    public array $locations;

    /**
     * FieldGroupLocations constructor.
     * 
     * @return void 
     */
    public function __construct()
    {
        $this->locations = [[]];
    }

    /**
     * Get current location index.
     * 
     * @return int 
     */
    private function getCurrentLocationIndex(): int
    {
        return count($this->locations) - 1;
    }

    /**
     * Add a location to the current location index.
     * 
     * @param string $parameter 
     * @param string $operator 
     * @param string $value 
     * @return FieldGroupLocations 
     */
    public function and(string $parameter, string $operator, string $value): self
    {
        $currentLocationIndex = $this->getCurrentLocationIndex();

        $this->locations[$currentLocationIndex][] = ['param' => $parameter, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    /**
     * Add a location to the next location index.
     * 
     * @param string $parameter 
     * @param string $operator 
     * @param string $value 
     * @return FieldGroupLocations 
     */
    public function or(string $parameter, string $operator, string $value): self
    {
        if (!empty($this->locations[$this->getCurrentLocationIndex()])) {
            $this->locations[] = [];
        }

        $currentLocationIndex = $this->getCurrentLocationIndex();

        $this->locations[$currentLocationIndex][] = ['param' => $parameter, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    /**
     * Build the location array.
     * 
     * @return array 
     */
    public function build()
    {
        return $this->locations;
    }
}
