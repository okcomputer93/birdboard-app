@extends('layouts.app')
@section('content')
    <div class="card bg-card lg:w-1/2 lg:mx-auto bg-white mt-4 p-6 md:px-16 md:py-12 rounded shadow">
        <h1 class="text-2xl font-normal mb-10 text-center">
            Let's start something new
        </h1>
        <form
            method="POST"
            action="/projects"
        >
            @include('projects._form', [
                'project' => new App\Models\Projects,
            ])
        </form>
    </div>
@endsection
