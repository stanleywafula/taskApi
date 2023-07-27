<?php

use App\Http\Controllers\Api\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('tasks', [TasksController::class, 'index']);
Route::post('tasks', [TasksController::class, 'store']);
Route::get('tasks/{id}', [TasksController::class, 'show']);
Route::get('tasks/{id}/edit', [TasksController::class, 'edit']);
Route::put('tasks/{id}/edit', [TasksController::class, 'update']);
Route::delete('tasks/{id}/delete', [TasksController::class, 'delete']);


