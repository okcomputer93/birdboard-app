<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectTasksController extends Controller
{
    public function store(Projects $project)
    {
        if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }
        \request()->validate([
            'body' => 'required'
        ]);
        $project->addTask(request('body'));

        return redirect($project->path());
    }
}
