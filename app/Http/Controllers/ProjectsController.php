<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
//        $projects = Projects::all();
        $projects = auth()->user()->accessibleProjects();

        return view('projects.index', compact('projects'));

    }
    public function store()
    {
        $project = auth()->user()->projects()
            ->create($this->validateRequest());

        if (\request()->wantsJson()) {
            return ['message' => $project->path()];
        }

        return redirect($project->path());
    }

    public function update(Projects $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateRequest());

        return redirect($project->path());

    }

    public function edit(Projects $project)
    {
        return view('projects.edit', compact('project'));
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

    public function destroy(Projects $project)
    {
        $this->authorize('manage', $project);

        $project->delete();

        return redirect('/projects');
    }

    protected function validateRequest(): array
    {
        return request()
            ->validate([
                'title' => 'sometimes|required',
                'description' => 'sometimes|required',
                'notes' => 'min:3'
            ]);
    }
}
