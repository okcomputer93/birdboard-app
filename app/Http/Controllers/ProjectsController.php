<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
//        $projects = Projects::all();
        $projects = auth()->user()->projects;

        return view('projects.index', compact('projects'));

    }
    public function store()
    {
        $project = auth()->user()->projects()
            ->create(\request()->validate([
                'title' => 'required',
                'description' => 'required',
                'notes' => 'min:3'
        ]));

        return redirect($project->path());
    }

    public function update(Projects $project)
    {
        $this->authorize('update', $project);

        $project->update(request(['notes']));

        return redirect($project->path());

    }

    public function show(Projects $project)
    {
        $this->authorize('update', $project);

        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }
}
