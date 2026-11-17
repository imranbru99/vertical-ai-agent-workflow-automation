<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\VerticalAgent;

class VerticalAgentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role->canOperateWorkflows();
    }

    public function view(User $user, VerticalAgent $verticalAgent): bool
    {
        return $user->role->canOperateWorkflows();
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Admin, UserRole::Manager], true);
    }

    public function update(User $user, VerticalAgent $verticalAgent): bool
    {
        return $this->create($user) || $user->role === UserRole::Demo;
    }

    public function delete(User $user, VerticalAgent $verticalAgent): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Admin], true);
    }
}
