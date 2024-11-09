<?php

namespace JorenRothman\ACFBuilder\Fields\Content;

use JorenRothman\ACFBuilder\Field;

class File extends FieldContent
{
    public string $return_format = 'array';

    public string $preview_size = 'thumbnail';

    public string $library = 'all';

    public int $min_size = 0;

    public int $max_size = 0;

    public string $mime_types = '';

    public function setType(): void
    {
        $this->type = 'file';
    }

    /**
     * Specify the return format.
     * options: array, url, id
     *
     * @param string $value
     * @return static
     */
    public function setReturnFormat(string $value): self
    {
        $this->return_format = $value;

        return $this;
    }

    /**
     * Specify the preview size.
     * options: thumbnail, medium, large, full
     *
     * @param string $value
     * @return static
     */
    public function setPreviewSize(string $value): self
    {
        $this->preview_size = $value;

        return $this;
    }

    /**
     * Specify the library.
     * options: all, uploadedTo
     *
     * @param string $value
     * @return static
     */
    public function setLibrary(string $value): self
    {
        $this->library = $value;

        return $this;
    }

    /**
     * Specify the minimum file size.
     *
     * @param int $value
     * @return static
     */
    public function setMinSize(int $value): self
    {
        $this->min_size = $value;

        return $this;
    }

    /**
     * Specify the maximum file size.
     *
     * @param int $value
     * @return static
     */
    public function setMaxSize(int $value): self
    {
        $this->max_size = $value;

        return $this;
    }

    /**
     * Specify the allowed mime types.
     *
     * @param string $value
     * @return static
     */
    public function setMimeTypes(string $value): self
    {
        $this->mime_types = $value;

        return $this;
    }
}
