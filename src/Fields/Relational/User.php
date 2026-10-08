<?php

namespace JorenRothman\ACFBuilder\Fields\Relational;

class User extends RelationalField
{
    public array $role = [];

    public bool $allow_null = false;

    public bool $multiple = false;

    public string $return_format = 'object';

    public function setType(): void
    {
        $this->type = 'user';
    }

    /**
     * Add a role.
     * 
     * @param string $role,... 
     * @return static 
     */
    public function addRole(string ...$role): static
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Set the allow null state.
     * 
     * @param bool $allow_null 
     * @return static 
     */
    public function setAllowNull(bool $allow_null): static
    {
        $this->allow_null = $allow_null;

        return $this;
    }

    /**
     * Set the multiple state.
     * 
     * @param bool $multiple 
     * @return static 
     */
    public function setMultiple(bool $multiple): static
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Set the return format.
     *
     * @param 'array'|'object'|'id' $return_format
     * @return static
     */
    public function setReturnFormat(string $return_format): static
    {
        $this->return_format = $return_format;

        return $this;
    }
}
