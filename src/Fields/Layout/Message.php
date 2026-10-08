<?php

namespace JorenRothman\ACFBuilder\Fields\Layout;

use JorenRothman\ACFBuilder\Field;

class Message extends Field
{
    public string $message = '';

    public string $new_lines = 'wpautop';

    public bool $esc_html = false;

    protected function setType(): void
    {
        $this->type = 'message';
    }

    /**
     * Set the message of the message
     *
     * @param string $message
     * @return static
     */
    public function setMessage(string $message): static
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the new lines of the message
     *
     * @param 'wpautop'|'br'|'' $new_lines
     * @return static
     */
    public function setNewLines(string $new_lines): static
    {
        $this->new_lines = $new_lines;

        return $this;
    }

    /**
     * Set the esc_html state of the message
     *
     * @param bool $esc_html
     * @return static
     */
    public function setEscHtml(bool $esc_html): static
    {
        $this->esc_html = $esc_html;

        return $this;
    }
}
