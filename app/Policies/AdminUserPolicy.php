<?php

namespace App\Policies;

use App\Models\User;

class AdminUserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
    }

public function index(User $user)
{
    return $user->hasUserViewPermission('user', ['view']);
}

public function create(User $user)
{
    return $user->hasUserViewPermission('user', ['create']);
}

public function store(User $user)
{
    return $user->hasUserViewPermission('user', ['create']);
}

public function edit(User $user)
{
    return $user->hasUserViewPermission('user', ['update']);
}

public function update(User $user)
{
    return $user->hasUserViewPermission('user', ['update']);
}

public function delete(User $user)
{
    return $user->hasUserViewPermission('user', ['delete']);
}

}
