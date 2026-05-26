<?php

namespace JorenRothman\ACFBuilder;

/**
 * Class FieldGroupLocations
 * 
 * @package JorenRothman\ACFBuilder
 */
class FieldGroupLocations
{
    public array $locations;

    /**
     * FieldGroupLocations constructor.
     * 
     * @return void 
     */
    public function __construct()
    {
        $this->locations = [[]];
    }

    /**
     * Get current location index.
     * 
     * @return int 
     */
    private function getCurrentLocationIndex(): int
    {
        return count($this->locations) - 1;
    }

    /**
     * Add a location to the current location index.
     *
     * @param 'post_type'|'post_template'|'post_status'|'post_format'|'post_category'|'post_taxonomy'|'post'|'page_template'|'page_type'|'page_parent'|'page'|'current_user'|'current_user_role'|'user_form'|'user_role'|'taxonomy'|'attachment'|'comment'|'widget'|'nav_menu'|'nav_menu_item'|'block'|'options_page' $parameter
     * @param '=='|'!=' $operator
     * @param string $value
     * @return FieldGroupLocations
     */
    public function and(string $parameter, string $operator, string $value): self
    {
        $currentLocationIndex = $this->getCurrentLocationIndex();

        $this->locations[$currentLocationIndex][] = ['param' => $parameter, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    /**
     * Add a location to the next location index.
     *
     * @param 'post_type'|'post_template'|'post_status'|'post_format'|'post_category'|'post_taxonomy'|'post'|'page_template'|'page_type'|'page_parent'|'page'|'current_user'|'current_user_role'|'user_form'|'user_role'|'taxonomy'|'attachment'|'comment'|'widget'|'nav_menu'|'nav_menu_item'|'block'|'options_page' $parameter
     * @param '=='|'!=' $operator
     * @param string $value
     * @return FieldGroupLocations
     */
    public function or(string $parameter, string $operator, string $value): self
    {
        if (!empty($this->locations[$this->getCurrentLocationIndex()])) {
            $this->locations[] = [];
        }

        $currentLocationIndex = $this->getCurrentLocationIndex();

        $this->locations[$currentLocationIndex][] = ['param' => $parameter, 'operator' => $operator, 'value' => $value];

        return $this;
    }

    /**
     * Build the location array.
     * 
     * @return array 
     */
    public function build()
    {
        return $this->locations;
    }
}
