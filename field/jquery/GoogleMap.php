<?php

namespace ACFBuilder\Field\Jquery;

use ACFBuilder\Field\Field;
use ACFBuilder\Field\Helpers\CenterLat;
use ACFBuilder\Field\Helpers\CenterLng;
use ACFBuilder\Field\Helpers\Height;
use ACFBuilder\Field\Helpers\Zoom;

class GoogleMap extends Field
{
    use Height;
    use Zoom;
    use CenterLat;
    use CenterLng;

    public function setType()
    {
        $this->type = 'google_map';
    }
}
