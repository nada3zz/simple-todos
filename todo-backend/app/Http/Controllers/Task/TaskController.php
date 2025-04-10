<?php

namespace App\Http\Controllers\Task;

use App\Models\Task\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Task\TaskService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;

class TaskController extends Controller
{
    public function __construct(protected TaskService $taskService)
    {
    }

    public function getAllTasks(): JsonResponse
    {
        $tasks = $this->taskService->getAllTasks(auth()->id());
        return response()->json($tasks);
    }


    public function createTask(CreateTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->createTask($request->validated(), auth()->id());
        return response()->json($task, 201);
        
    }


    public function updateTask(UpdateTaskRequest $request, Task $task): JsonResponse
    {
        $this->authorize('update', $task);
        $task = $this->taskService->updateTask($task, $request->validated());
        return response()->json($task);     
    }

    public function showTask(Task $task): JsonResponse
    {
        $this->authorize('view', $task);
        return response()->json($task);
    }
    
    public function deleteTask(Task $task)
    {
        $this->authorize('delete', $task);
        $this->taskService->deleteTask($task);
        return response()->json(null, 204);
    }

    public function restore($taskId): JsonResponse
    {
        $task = $this->taskService->restoreTask($taskId);
        $this->authorize('restore', $task);
        return response()->json($task);
    }

    public function getAllDeletedTasks(): JsonResponse
    {
        $tasks = $this->taskService->getAllDeletedTasks(auth()->id());
        return response()->json($tasks);
    }
}

