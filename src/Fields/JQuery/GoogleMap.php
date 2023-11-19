<?php

namespace JorenRothman\ACFBuilder\Fields\JQuery;

class GoogleMap extends JQueryField
{
    public string $center_lat = '';

    public string $center_lng = '';

    public string $zoom = '';

    public string $height = '';

    public function setType(): void
    {
        $this->type = 'google_map';
    }

    /**
     * Set the center lat.
     * 
     * @param string $center_lat 
     * @return self 
     */
    public function setCenterLat(string $center_lat): self
    {
        $this->center_lat = $center_lat;

        return $this;
    }

    /**
     * Set the center lng.
     * 
     * @param string $center_lng 
     * @return self 
     */
    public function setCenterLng(string $center_lng): self
    {
        $this->center_lng = $center_lng;

        return $this;
    }

    /**
     * Set the zoom.
     * 
     * @param string $zoom 
     * @return self 
     */
    public function setZoom(string $zoom): self
    {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Set the height.
     * 
     * @param string $height 
     * @return self 
     */
    public function setHeight(string $height): self
    {
        $this->height = $height;

        return $this;
    }
}
