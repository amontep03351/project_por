<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard_controller;
use App\Http\Controllers\user_controller;
use App\Http\Controllers\project_controller;
use App\Http\Controllers\task_controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [dashboard_controller::class, 'index']);
Route::get('/dashboard', [dashboard_controller::class, 'dashboard']);
Route::get('/Home', [dashboard_controller::class, 'Home']);
Route::get('/Home/getListTask', [dashboard_controller::class, 'getListTask']); 



Route::get('/ManageUsers', [user_controller::class, 'index']);
Route::get('/api/users', [user_controller::class, 'getUsers']);
Route::get('/users/create', [user_controller::class, 'create']);
Route::post('/users/store', [user_controller::class, 'store']);
Route::post('/users/editUser',[user_controller::class, 'edit']);
Route::post('/users/updateUser', [user_controller::class, 'updateUser']);



Route::get('/ManageProjects', [project_controller::class, 'index']);
Route::get('/api/Projects', [project_controller::class, 'getProjects']);
Route::get('/Projects/create', [project_controller::class, 'create']);
Route::post('/Projects/store', [project_controller::class, 'store']);
Route::post('/Projects/editProjects',[project_controller::class, 'edit']);
Route::post('/Projects/updateProjects', [project_controller::class, 'updateproject']);


Route::get('/ManageTasks', [task_controller::class, 'index']);
Route::get('/api/Tasks', [task_controller::class, 'getTasks']);
Route::get('/Tasks/create', [task_controller::class, 'create']);
Route::post('/Tasks/store', [task_controller::class, 'store']);
Route::post('/Tasks/editTasks',[task_controller::class, 'edit']);
Route::post('/Tasks/updateTasks', [task_controller::class, 'updatetask']);
