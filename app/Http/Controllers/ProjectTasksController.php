<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Projects $project)
    {
        $this->authorize('update', $project);

        \request()->validate([
            'body' => 'required'
        ]);
        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Projects $project, Task $task)
    {
        $this->authorize('update', $task->project);

        $task->update(\request()->validate([
                'body' => 'required'
            ]));

        request('completed') ? $task->complete() : $task->incomplete();

        return redirect($project->path());
    }
}
