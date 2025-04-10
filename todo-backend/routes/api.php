<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



Route::middleware('auth:sanctum')->group(function () {
    // Task Routes
    Route::get('/tasks', [TaskController::class, 'getAllTasks']);
    Route::post('/tasks', [TaskController::class, 'createTask']);
    Route::get('/tasks/{task}', [TaskController::class, 'showTask']);
    Route::put('/tasks/{task}', [TaskController::class, 'updateTask']);
    Route::delete('/tasks/{task}', [TaskController::class, 'deleteTask']);
    Route::post('/tasks/{task}/restore', [TaskController::class, 'restoreTask']);
    Route::get('/tasks/deleted', [TaskController::class, 'getAllDeletedTasks']);

    // Category Routes
    Route::get('/categories', [CategoryController::class, 'getAllCategories']);
    Route::post('/categories', [CategoryController::class, 'createCategory']);
    Route::get('/categories/{category}', [CategoryController::class, 'showCategory']);
    Route::put('/categories/{category}', [CategoryController::class, 'updateCategory']);
    Route::delete('/categories/{category}', [CategoryController::class, 'deleteCategory']);
});
