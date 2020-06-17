<?php

namespace ACFBuilder\Field\Helpers;

trait Endpoint
{
    public $endpoint;

    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
    }
}
