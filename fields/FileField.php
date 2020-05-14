<?php

namespace ACFBuilder\Fields;

class FileField extends Field
{
    public $returnFormat = 'array';

    public $previewSize = 'thumbnail';

    public $library = 'all';

    public $minSize = 0;

    public $maxSize = 0;

    public $mimeTypes = '';

    public function setType()
    {
        $this->type = 'file';
    }

    /**
     * Choices 'array', 'url', 'id'
     *
     * @param string $returnFormat
     * @return void
     */
    public function setReturnFormat($returnFormat)
    {
        $this->returnFormat = $returnFormat;
    }

    public function setPreviewSize($imageSize)
    {
        $this->previewSize = $imageSize;
    }

    /**
     * Choices 'all', 'uploadedTo'
     *
     * @param string $library
     * @return void
     */
    public function setLibrary($library)
    {
        $this->library = $library;
    }

    public function setMinSize($minSize)
    {
        $this->minSize = (int) $minSize;
    }

    public function setMaxSize($maxSize)
    {
        $this->maxSize = (int) $maxSize;
    }

    public function setMimeTypes($mimeTypes)
    {
        $this->mimeTypes = $mimeTypes;
    }
}
