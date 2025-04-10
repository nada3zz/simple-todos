<?php

namespace App\Services\Task;

use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Collection;


class TaskService
{
    public function getAllTasks(int $userId): Collection
    {
        return Task::where('user_id', $userId)->get();
    }

    public function createTask(array $data, int $userId): Task
    {
        $data['user_id'] = $userId;
        return Task::create($data);
    }

    public function updateTask(Task $task, array $data): Task
    {
        $task->update($data);
        return $task->fresh();
    }

    public function deleteTask(Task $task): void
    {
        $task->delete();
    }

    public function restoreTask($taskId): Task
    {
        $task = Task::withTrashed()->findOrFail($taskId);
        $task->restore();
        return $task;
    }
  
    public function getAllDeletedTasks(int $userId): Collection
    {
        return Task::onlyTrashed()->where('user_id', $userId)->get();
    }
}