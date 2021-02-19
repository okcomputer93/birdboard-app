@extends('layouts.app')
@section('content')
    <header class="flex items-center mb-3 pb-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey-font text-sm font-normal self-center">
                <a class="text-grey-font text-sm font-normal no-underline hover:underline" href="/projects">My Projects</a> / {{ $project->title }}
            </p>

            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img
                        src="{{ gravatar_url($member->email) }}"
                        alt="{{ $member->name }}'s avatar"
                        class="rounded-full w-8 mr-2">
                @endforeach

                    <img
                        src="{{ gravatar_url($project->owner->name) }}"
                        alt="{{ $project->owner->name }}'s avatar"
                        class="rounded-full w-8 mr-2">


                    <a class="button-blue ml-6" href="{{ $project->path() . '/edit' }}">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -m-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <label for="body" class="inline-block text-grey-font text-lg font-normal mb-3">Tasks</label>
    {{--                tasks--}}
                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="post" action="{{ $task->path() }}">
                                @method("PATCH")
                                @csrf
                                <div class="flex">
                                    <input name="body" class="w-full {{ $task->completed ? 'text-grey-font' : '' }}" value="{{ $task->body }}">
                                    <input {{ $task->completed ? 'checked' : '' }} type="checkbox" name="completed" id="completed" onchange="this.form.submit()">
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <form method="post" action="{{ $project->path() . '/tasks' }}">
                        @method("POST")
                        @csrf
                        <input class="border-solid border-2 focus:outline-none rounded focus:border-blue-light card mb-3 w-full" name="body" id="body" placeholder="Add a new task...">
                    </form>
                    @error('body')
                        <li class="text-sm text-red-700 list-none">{{ $message }}</li>
                    @enderror
                </div>
                <div>
                    <label for="notes" class="block text-grey-font text-lg font-normal mb-3">General Notes</label>
    {{--                General notes--}}
                    <form method="post" action="{{ $project->path() }}">
                        @csrf
                        @method('PATCH')
                        <textarea
                            name="notes"
                            id="notes"
                            rows="10"
                            class="border-solid border-2 focus:outline-none rounded focus:border-blue-light w-full card mb-4"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>
                        <button type="submit" class="button-blue">Save</button>
                    </form>
                    @error('notes')
                      <li class="text-sm text-red-700 pt-3 list-none">{{ $message }}</li>
                    @enderror
                </div>
            </div>
            <div class="lg:w-1/4 px-3 lg:mt-10">
                @include('projects.card')
                @include('projects.activity.card')
                @can('manage', $project)
                    @include('projects.invite')
                @endcan
            </div>
        </div>
    </main>
@endsection
