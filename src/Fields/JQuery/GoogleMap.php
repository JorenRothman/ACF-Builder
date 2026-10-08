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
     * @return static 
     */
    public function setCenterLat(string $center_lat): static
    {
        $this->center_lat = $center_lat;

        return $this;
    }

    /**
     * Set the center lng.
     * 
     * @param string $center_lng 
     * @return static 
     */
    public function setCenterLng(string $center_lng): static
    {
        $this->center_lng = $center_lng;

        return $this;
    }

    /**
     * Set the zoom.
     * 
     * @param string $zoom 
     * @return static 
     */
    public function setZoom(string $zoom): static
    {
        $this->zoom = $zoom;

        return $this;
    }

    /**
     * Set the height.
     * 
     * @param string $height 
     * @return static 
     */
    public function setHeight(string $height): static
    {
        $this->height = $height;

        return $this;
    }
}
