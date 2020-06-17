<?php

namespace ACFBuilder\Field\Helpers;

trait AllowArchives
{
    public $allowArchives;

    public function setAllowArchives($allowArchives)
    {
        $this->allowArchives = $allowArchives;
    }
}
