@extends('layouts.app')
@section('content')
    <header class="flex items-end justify-between mb-3 py-4">
        <p class="text-grey-font text-sm font-normal">
            <a class="text-grey-font text-sm font-normal no-underline" href="/projects">My Projects</a> / {{ $project->title }}
        </p>
        <a class="button-blue" href="/projects/create">New Project</a>
    </header>

    <main>
        <div class="lg:flex -m-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-grey-font text-lg font-normal mb-3">Tasks</h2>
    {{--                tasks--}}
                    @forelse($project->tasks as $task)
                        <div class="card mb-3">{{ $task->body }}</div>
                    @empty
                        Wow such empty!
                    @endforelse
                    <div class="card mb-3">Lorem Ipsum.</div>
                    <div class="card mb-3">Lorem Ipsum.</div>
                    <div class="card">Lorem Ipsum.</div>
                </div>

                <div>
                    <label for="notes" class="block text-grey-font text-lg font-normal mb-3">General Notes</label>
    {{--                General notes--}}
                    <textarea id="notes" rows="10" class="w-full card mb-3">Lorem Ipsum.</textarea>
                </div>
            </div>
            <div class="lg:w-1/4 px-3">
                @include('projects.card')
            </div>
        </div>
    </main>
@endsection
