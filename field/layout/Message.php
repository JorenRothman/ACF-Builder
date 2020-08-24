<?php

namespace ACFBuilder\Field\Layout;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\EscHtml;
use ACFBuilder\Field\Helpers\Message as HelpersMessage;
use ACFBuilder\Field\Helpers\NewLines;

class Message extends Field
{
    use NewLines;
    use HelpersMessage;
    use EscHtml;

    public function setType()
    {
        $this->type = 'message';
    }
}
