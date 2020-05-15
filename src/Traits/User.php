<?php

namespace Salyam\Permissions\Traits;

trait User
{
	/**
     * Returns a collection of roles of a user.
     */
    public function roles()
    {
        return $this->belongsToMany('\Salyam\Permissions\Models\Role');
    }

    /**
     * Returns a collection of permissions which a user has.
     * The returned permissions include every permission the user has directly, or is assigned to one of the roles of the user.
     */
    public function permissions()
    {
        return $this->cb_directPermissions()->union($this->cb_indirectPermissions());
    }

    /**
     * Checks if a user has any role from a set of roles.
     * 
     * @return boolean
     *  True if the user has any of the given roles, false otherwise.
     */
    public function HasAnyRole(array $values)
    {
        foreach($values as $value)
        {
            if($this->HasRole($value))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if a user has every role from a set of roles.
     * 
     * @return boolean
     *  True if the user has every given roles, false otherwise.
     */
    public function HasEveryRole(array $values)
    {
        foreach($values as $value)
        {
            if(!$this->HasRole($value))
            {
                return false;
            }
        }
        return true;
    }

    /**
     * Checks if a user has a role.
     * 
     * @param[in] $value 
     *  The role to be checked.
     *  This parameter can be an integer, a string, or a Role object. 
     *  In case it is an integer, the role will be searched by ID; in case it is a string, the role will be selected by name.
     * 
     * @return boolean
     *  True if the user has the given role, false otherwise.
     * 
     * @throws InvalidArgumentException in case $value is not an integer, string or a Role object
     */
    public function HasRole($value) : bool
     {
        if(is_int($value)) 
        {
            return $this->roles()->get()->contains($value);
        }
        else if(is_string($value)) 
        {
            $role = \Salyam\Permissions\Models\Role::firstWhere('name', '=', $value);
            if(!is_null($role))
            {
                return $this->HasRole($role);
            }
            else
            {
                return false;
            }
        }
        else if($value instanceof \Salyam\Permissions\Models\Role)
        {
            return $this->roles()->get()->contains($value->id);
        }
        else
        {
            throw new InvalidArgumentException("Input argument must be an integer, a string, or a Role object.");
        }
    }

    /**
     * Assigns a role to a user.
     * 
     * @param[in] $value
     *  The role which will be assigned to the user.
     *  This parameter can be an integer, a string, or a Role object. 
     *  In case it is an integer, the role will be searched by ID; in case it is a string, the role will be selected by name.
     * 
     * @throws InvalidArgumentException in case $value is not an integer, string or a Role object
     */
    public function GrantRole($value) {
        if(is_int($value))
        {
            $this->roles()->attach($value);
        }
        else if(is_string($value))
        {
            $role = \Salyam\Permissions\Models\Role::firstWhere('name', '=', $value);
            if(!is_null($role))
            {
                $this->GrantRole($role);
            }
        }
        else if($value instanceof \Salyam\Permissions\Models\Role)
        {
            $this->roles()->attach($value->id);
        }
        else
        {
            throw new InvalidArgumentException("Input argument must be an integer, a string, or a Role object.");
        }
    }
 
    /**
     * Removes a role from a users assigned roles.
     * 
     * @param[in] $value
     *  The role which will be assigned to the user.
     *  This parameter can be an integer, a string, or a Role object. 
     *  In case it is an integer, the role will be searched by ID; in case it is a string, the role will be selected by name.
     * 
     * @throws InvalidArgumentException in case $value is not an integer, string or a Role object
     */
    public function RevokeRole($value)
    {
        if(is_int($value))
        {
            $this->roles()->detach($value);
        }
         else if(is_string($value))
         {
            $role = \Salyam\Permissions\Models\Role::firstWhere('name', '=', $value);
            if(!is_null($role))
            {    
                $this->RevokeRole($role);
            }
        }
        else if($value instanceof \Salyam\Permissions\Models\Role)
        {
            $this->roles()->detach($value->id);
        }
        else
        {
            throw new InvalidArgumentException("Input argument must be an integer, a string, or a Role object.");
        }
    }

    /**
     * Checks if a user has any permission from a set of permissions.
     * 
     * @return boolean
     *  True if the user has any of the given permissions, false otherwise.
     */
    public function HasAnyPermission(array $values)
    {
        foreach($values as $value)
        {
            if($this->HasPermission($value))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if a user has every permission from a set of permissions.
     * 
     * @return boolean
     *  True if the user has every given permissions, false otherwise.
     */
    public function HasEveryPermission(array $values)
    {
        foreach($values as $value)
        {
            if(!$this->HasPermission($value))
            {
                return false;
            }
        }
        return true;
    }

    /**
     * Checks if a user has a permission.
     * 
     * @param[in] $value 
     *  The permission to be checked.
     *  This parameter can be an integer, a string, or a Permission object. 
     *  In case it is an integer, the permission will be searched by ID; in case it is a string, the permission will be selected by name.
     * 
     * @return boolean
     *  True if the user has the given permission, false otherwise.
     * 
     * @throws InvalidArgumentException in case $value is not an integer, string or a Permission object
     */
    public function HasPermission($value) : bool
    {
        if(is_int($value))
        {
            $this->permissions()->get()->contains($value);
        }
        else if(is_string($value))
        {
            $permission = \Salyam\Permissions\Models\Permission::firstWhere('name', '=', $value);
            if(!is_null($permission))
            {
                $this->HasPermission($permission);
            }
        }
        else if($value instanceof \Salyam\Permissions\Models\Permission)
        {
            $this->permissions()->get()->contains($value->id);
        }
        else
        {
            throw new InvalidArgumentException("Input argument must be an integer, a string, or a Permission object.");
        }
    }

    /**
     * Assigns a permission to a user.
     * 
     * @param[in] $value
     *  The permission which will be assigned to the user.
     *  This parameter can be an integer, a string, or a Permission object. 
     *  In case it is an integer, the permission will be searched by ID; in case it is a string, the permission will be selected by name.
     * 
     * @throws InvalidArgumentException in case $value is not an integer, string or a Permission object
     */
    public function GrantPermission($value)
    {
        if(is_int($value))
        {
            $this->cb_directPermissions()->attach($value);
        }
        else if(is_string($value)) {
            $permission = \Salyam\Permissions\Models\Permission::firstWhere('name', '=', $value);
            if(!is_null($permission))
            {
                $this->GrantPermission($permission);
            }
        }
        else if($value instanceof \Salyam\Permissions\Models\Permission)
        {
            $this->cb_directPermissions()->attach($value->id);
        }
        else
        {
            throw new InvalidArgumentException("Input argument must be an integer, a string, or a Permission object.");
        }
    }

    /**
     * Removes a permission from a users assigned permissions.
     * 
     * @param[in] $value
     *  The permission which will be assigned to the user.
     *  This parameter can be an integer, a string, or a Permission object. 
     *  In case it is an integer, the permission will be searched by ID; in case it is a string, the permission will be selected by name.
     * 
     * @throws InvalidArgumentException in case $value is not an integer, string or a Permission object
     */
    public function RevokePermission($value)
    {
        if(is_int($value))
        {
            $this->cb_directPermissions()->detach($value);
        }
        else if(is_string($value))
        {
            $permission = \Salyam\Permissions\Models\Permission::firstWhere('name', '=', $value);
            if(!is_null($permission))
            {
                $this->RevokePermission($permission);
            }
        }
        else if($value instanceof \Salyam\Permissions\Models\Permission)
        {
            $this->cb_directPermissions()->detach($value->id);
        }
        else
        {
            throw new InvalidArgumentException("Input argument must be an integer, a string, or a Permission object.");
        }
    }

    private function cb_directPermissions() 
    {
        return $this->belongsToMany('\Salyam\Permissions\Models\Permission');
    }

    private function cb_indirectPermissions() 
    {
        return $this->hasManyThrough('\Salyam\Permissions\Models\Permission', '\Salyam\Permissions\Models\Role');
    }
}