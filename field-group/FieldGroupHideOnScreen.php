<?php

namespace ACFBuilder\FieldGroup;

use ACFBuilder\IsBuildable;
use ACFBuilder\Util\ObjectUtil;

class FieldGroupHideOnScreen implements IsBuildable
{
    private $itemsToHide = [];

    private function addToItems($value)
    {
        if (!in_array($value, $this->itemsToHide)) {
            $this->itemsToHide[] = $value;
        }
    }

    public function setPermalink()
    {
        $this->addToItems('permalink');
    }

    public function setTheContent()
    {
        $this->addToItems('the_content');
    }

    public function setExcerpt()
    {
        $this->addToItems('excerpt');
    }

    public function setDiscussion()
    {
        $this->addToItems('discussion');
    }

    public function setComments()
    {
        $this->addToItems('comments');
    }


    public function setRevisions()
    {
        $this->addToItems('revisions');
    }

    public function setSlug()
    {
        $this->addToItems('slug');
    }

    public function setAuthor()
    {
        $this->addToItems('author');
    }

    public function setFormat()
    {
        $this->addToItems('format');
    }

    public function setPageAttributes()
    {
        $this->addToItems('page_attributes');
    }

    public function setFeaturedImage()
    {
        $this->addToItems('featured_image');
    }

    public function setCategories()
    {
        $this->addToItems('categories');
    }

    public function setTags()
    {
        $this->addToItems('tags');
    }

    public function setTrackbacks()
    {
        $this->addToItems('send-trackbacks');
    }

    public function build()
    {
        return $this->itemsToHide;
    }
}
