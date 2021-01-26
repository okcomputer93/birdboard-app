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
        Projects::create(\request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]));
        return redirect('/projects');
    }
}
