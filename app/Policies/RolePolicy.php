<?php

namespace App\Policies;

use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    
    }

    public function show(User $user){
        return $user->hasRoleViewPermission('role', ['view']);
    }
    public function create(User $user)
    {
    return $user->hasRoleViewPermission('role', ['create']);
    }

    public function store(User $user)
{
    return $user->hasRoleViewPermission('role', ['create']);
}

public function edit(User $user)
{
    return $user->hasRoleViewPermission('role', ['update']);
}

public function update(User $user)
{
    return $user->hasRoleViewPermission('role', ['update']);
}

public function delete(User $user)
{
    return $user->hasRoleViewPermission('role', ['delete']);
}




}
