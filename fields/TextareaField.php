<?php

namespace ACFBuilder\Fields;

class TextareaField extends Field
{
    public $rows = '';

    public $newLines = 'wpautop';

    public function setType()
    {
        $this->type = 'textarea';
    }

    public function setRows($rows)
    {
        $this->rows = (string) $rows;
    }

    /**
     * Choices wpautop | br | ''
     *
     * @param string $newLines
     * @return void
     */
    public function setNewLines($newLines)
    {
        $this->newLines = $newLines;
    }
}
