<?php

namespace JorenRothman\ACFBuilder\Fields\Content;

use JorenRothman\ACFBuilder\Field;

class Gallery extends FieldContent
{
    public int $min = 0;

    public int $max = 0;

    public string $preview_size = 'thumbnail';

    public string $library = 'all';

    public int $min_width = 0;

    public int $min_height = 0;

    public int $min_size = 0;

    public int $max_width = 0;

    public int $max_height = 0;

    public int $max_size = 0;

    public string $mime_types = '';

    public function setType(): void
    {
        $this->type = 'gallery';
    }

    /**
     * Specify the minimum number of images.
     *
     * @param int $value
     * @return static
     */
    public function setMin(int $value): self
    {
        $this->min = $value;

        return $this;
    }

    /**
     * Specify the maximum number of images.
     *
     * @param int $value
     * @return static
     */
    public function setMax(int $value): self
    {
        $this->max = $value;

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
     * Specify the minimum width.
     *
     * @param int $value
     * @return static
     */
    public function setMinWidth(int $value): self
    {
        $this->min_width = $value;

        return $this;
    }

    /**
     * Specify the minimum height.
     *
     * @param int $value
     * @return static
     */
    public function setMinHeight(int $value): self
    {
        $this->min_height = $value;

        return $this;
    }

    /**
     * Specify the minimum size.
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
     * Specify the maximum width.
     *
     * @param int $value
     * @return static
     */
    public function setMaxWidth(int $value): self
    {
        $this->max_width = $value;

        return $this;
    }

    /**
     * Specify the maximum height.
     *
     * @param int $value
     * @return static
     */
    public function setMaxHeight(int $value): self
    {
        $this->max_height = $value;

        return $this;
    }

    /**
     * Specify the maximum size.
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
     * Specify the mime types.
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
