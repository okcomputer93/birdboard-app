@extends('layouts.app')
@section('content')
    <div class="card bg-card lg:w-1/2 lg:mx-auto bg-white mt-4 p-6 md:px-16 md:py-12 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">
            Edit your project
        </h1>
        <form
            method="POST"
            action="{{ $project->path() }}"
        >
            @method("PATCH")
            @include('projects._form')
        </form>
    </div>
@endsection
