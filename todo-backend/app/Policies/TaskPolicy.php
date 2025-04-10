<?php

namespace App\Policies\Task;

use App\Models\Task\Task;
use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function update(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function delete(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }

    public function restore(User $user, Task $task): bool
    {
        return $user->id === $task->user_id;
    }
}