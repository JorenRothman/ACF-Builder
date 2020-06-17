<?php

namespace ACFBuilder\Field\Helpers;

trait PostType
{
    public $postType;

    public function setPostType($postType)
    {
        $this->postType = $postType;
    }
}
