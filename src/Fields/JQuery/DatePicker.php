<?php

namespace JorenRothman\ACFBuilder\Fields\JQuery;

class DatePicker extends DateField
{
    public string $display_format = 'd/m/Y';

    public string $return_format = 'd/m/Y';

    public function setType(): void
    {
        $this->type = 'date_picker';
    }
}
