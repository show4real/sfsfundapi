<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\ApproverController;
use App\Http\Controllers\Api\DepartmentController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('signup', 'signup');
    Route::post('login', 'login');
});

Route::controller(DepartmentController::class)->group(function () {
    Route::get('departments', 'index');
});

Route::middleware(['auth:api','CheckStaff'])->group(function () {


    Route::controller(TaskController::class)->group(function () {
        Route::post('staff/tasks', 'myTasks');
        Route::post('task/store', 'create');
        Route::post('update/task/{task}', 'update');
        Route::post('delete/task/{id}', 'delete');
       
    });

});

Route::middleware(['auth:api','CheckApprover'])->group(function () {


    Route::controller(ApproverController::class)->group(function () {
        Route::post('approver/tasks', 'tasks');
        Route::post('users', 'users');
        Route::post('approve/task/{task}', 'approve');
       
    });

});

