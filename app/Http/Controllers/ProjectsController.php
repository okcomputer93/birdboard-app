<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index()
    {
        $projects = Projects::all();
        return view('projects.index', compact('projects'));

    }
    public function store()
    {
        $attributes = \request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $attributes['owner_id'] = auth()->id();
        Projects::create($attributes);

        return redirect('/projects');
    }

    public function show(Projects $project)
    {
        return view('projects.show', compact('project'));
    }
}
