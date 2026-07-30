<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SportsType;

class SportsTypePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role->role === 'manager';
    }

    public function update(User $user, SportsType $specialty): bool
    {
        return $user->role->role === 'manager';
    }

    public function delete(User $user, SportsType $specialty): bool
    {
        return $user->role->role === 'manager';
    }

    public function create(User $user): bool
    {
        return $user->role->role === 'manager';
    }
}
