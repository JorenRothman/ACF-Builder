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
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the new lines of the message
     * options: wpautop, br, empty string for no new lines
     *
     * @param string $new_lines
     * @return self
     */
    public function setNewLines(string $new_lines): self
    {
        $this->new_lines = $new_lines;

        return $this;
    }

    /**
     * Set the esc_html state of the message
     *
     * @param bool $esc_html
     * @return self
     */
    public function setEscHtml(bool $esc_html): self
    {
        $this->esc_html = $esc_html;

        return $this;
    }
}
