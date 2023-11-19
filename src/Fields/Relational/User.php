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
     * @return self 
     */
    public function addRole(string ...$role): self
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Set the allow null state.
     * 
     * @param bool $allow_null 
     * @return self 
     */
    public function setAllowNull(bool $allow_null): self
    {
        $this->allow_null = $allow_null;

        return $this;
    }

    /**
     * Set the multiple state.
     * 
     * @param bool $multiple 
     * @return self 
     */
    public function setMultiple(bool $multiple): self
    {
        $this->multiple = $multiple;

        return $this;
    }

    /**
     * Set the return format.
     * options: array, object, id
     * 
     * @param string $return_format 
     * @return self 
     */
    public function setReturnFormat(string $return_format): self
    {
        $this->return_format = $return_format;

        return $this;
    }
}
