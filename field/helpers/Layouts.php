<?php

namespace ACFBuilder\Field\Helpers;

trait Layouts
{
    public $layouts = [];

    public function addLayout($layout)
    {
        $layout->onLayoutAdd($this->name);

        $this->layouts[] = $layout;
    }

    public function build()
    {
        $this->layouts = array_map(function ($layout) {
            return $layout->build();
        }, $this->layouts);

        return parent::build();
    }
}
