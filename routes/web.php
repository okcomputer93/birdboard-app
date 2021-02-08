<?php

use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\ProjectTasksController;
use Illuminate\Support\Facades\Route;

\App\Models\Projects::created(function ($project) {
    App\Models\Activity::create([
       'project_id' => $project->id,
        'description' => 'created'
    ]);
});

\App\Models\Projects::updated(function ($project) {
    App\Models\Activity::create([
        'project_id' => $project->id,
        'description' => 'updated'
        ]);
    });

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
Route::group(['middleware' => 'auth'], function (){
    Route::get('/projects', [ProjectsController::class, 'index']);
    Route::get('/projects/create', [ProjectsController::class, 'create']);
    Route::get('/projects/{project}', [ProjectsController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectsController::class, 'edit']);
    Route::patch('/projects/{project}', [ProjectsController::class, 'update']);
    Route::post('/projects/{project}/tasks', [ProjectTasksController::class, 'store']);
    Route::patch('/projects/{project}/tasks/{task}', [ProjectTasksController::class, 'update']);
    Route::post('/projects', [ProjectsController::class, 'store']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});




Auth::routes();

