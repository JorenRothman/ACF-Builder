<?php

namespace ACFBuilder\Fields;

class WysiwygField extends Field
{
    public $tabs = 'all';

    public $toolbar = 'full';

    public $mediaUpload = 1;

    public function setType()
    {
        $this->type = 'wysiwyg';
    }

    /**
     * Choices are 'all', 'visual', 'text'
     *
     * @param string $tabs
     * @return void
     */
    public function setTabs($tabs)
    {
        $this->tabs = $tabs;
    }

    /**
     * Choices are 'full', 'basic',  or a custom toolbar (https://www.advancedcustomfields.com/resources/customize-the-wysiwyg-toolbars/)
     *
     * @param string $toolbar
     * @return void
     */
    public function setToolbar($toolbar)
    {
        $this->toolbar = $toolbar;
    }

    /**
     * Set media upload
     *
     * @param boolean $enable
     * @return void
     */
    public function setMediaUpload($enable)
    {
        $this->mediaUpload = intval($enable);
    }
}
