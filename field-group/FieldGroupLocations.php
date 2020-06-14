<?php

namespace ACFBuilder\FieldGroup;

use ACFBuilder\IsBuildable;

class FieldGroupLocations implements IsBuildable
{
    public $locations = [];

    public function addLocation($location)
    {
        $this->locations[] = $location;
    }

    public function build()
    {
        $locations = [];

        foreach ($this->locations as $location) {
            $locations[] = $location->build();
        }

        return $locations;
    }
}
