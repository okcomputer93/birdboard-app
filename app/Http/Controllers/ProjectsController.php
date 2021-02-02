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
        ]));

        return redirect($project->path());
    }

    public function show(Projects $project)
    {
        if(auth()->user()->isNot($project->owner)) {
            abort(403);
        }
        return view('projects.show', compact('project'));
    }

    public function create()
    {
        return view('projects.create');
    }
}
