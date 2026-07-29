<?php

namespace App\Policies;

use App\Models\Trainer;
use App\Models\User;

class TrainerPolicy
{
    public function view(User $user, Trainer $trainer): bool
    {
        return in_array($user->role->role, ['employee', 'manager']);
    }

    public function edit(User $user, Trainer $trainer): bool
    {
        return in_array($user->role->role, ['employee', 'manager']);
    }

    public function delete(User $user, Trainer $trainer): bool
    {
        return $user->role->role === 'manager';
    }

    public function editStatus(User $user, Trainer $trainer): bool
    {
        return $user->role->role === 'manager';
    }

    public function editSpecialization(User $user, Trainer $trainer): bool
    {
        return $user->role->role === 'manager';
    }
}
