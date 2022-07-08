<?php

namespace Joren\ACFBuilder;

class FieldGroupLocations
{
    public array $locations;

    public function __construct()
    {
        $this->locations = [[]];
    }

    private function getCurrentLocationIndex(): int
    {
        return count($this->locations) - 1;
    }

    public function and(string $parameter, string $operator, string $value): self
    {
        $currentLocationIndex = $this->getCurrentLocationIndex();

        $this->locations[$currentLocationIndex][] = [$parameter, $operator, $value];

        return $this;
    }

    public function or(string $parameter, string $operator, string $value): self
    {
        if (!empty($this->locations[$this->getCurrentLocationIndex()])) {
            $this->locations[] = [];
        }

        $currentLocationIndex = $this->getCurrentLocationIndex();

        $this->locations[$currentLocationIndex][] = [$parameter, $operator, $value];

        return $this;
    }

    public function build()
    {
        return $this->locations;
    }
}
