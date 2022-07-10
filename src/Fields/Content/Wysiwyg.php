<?php

namespace Joren\ACFBuilder\Fields\Content;

use Joren\ACFBuilder\Field;

class Wysiwyg extends Field
{
    public string $tabs = 'all';

    public string $toolbar = 'full';

    public bool $media_upload = false;

    public function setType(): void
    {
        $this->type = 'wysiwyg';
    }

    /**
     * Specify which tabs are available.
     * options: all, visual, text
     *
     * @param string $value
     * @return Field
     */
    public function setTabs(string $value): self
    {
        $this->tabs = $value;

        return $this;
    }

    /**
     * Specify the editor's toolbar.
     * options: full, basic
     *
     * @param string $value
     * @return Field
     */
    public function setToolbar(string $value): self
    {
        $this->toolbar = $value;

        return $this;
    }

    /**
     * Show the media upload button.
     *
     * @param bool $value
     * @return Field
     */
    public function setMediaUpload(bool $value): self
    {
        $this->media_upload = $value;

        return $this;
    }
}
