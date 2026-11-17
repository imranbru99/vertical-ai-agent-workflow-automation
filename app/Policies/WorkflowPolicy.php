<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\User;
use App\Models\Workflow;

class WorkflowPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->role->canOperateWorkflows();
    }

    public function view(User $user, Workflow $workflow): bool
    {
        return $user->role->canOperateWorkflows();
    }

    public function create(User $user): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Admin, UserRole::Manager, UserRole::Demo], true);
    }

    public function update(User $user, Workflow $workflow): bool
    {
        if ($user->role === UserRole::Staff) {
            return $workflow->owner_id === $user->id;
        }

        return $this->create($user);
    }

    public function delete(User $user, Workflow $workflow): bool
    {
        return in_array($user->role, [UserRole::SuperAdmin, UserRole::Admin], true);
    }
}
