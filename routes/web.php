<?php

use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/tasks');
Route::get('/createEmptyTask/{id}', [SubTaskController::class, 'createEmptyTask']);
Route::post('/addTaskNote/{id}', [SubTaskController::class, 'addTaskNote']);
Route::post('/update-row-order', [SubTaskController::class, 'updateOrder']);

Route::resource('tasks', TaskController::class);
Route::resource('subTask', SubTaskController::class);