@extends ('layouts.app')
@section('content')
    <header class="flex items-end justify-between mb-3 py-4">
        <h2 class="text-muted text-sm font-normal">My Projects</h2>
        <a class="button-blue" href="/projects/create">New Project</a>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </main>

    <modal name="my-first-modal" classes="p-10 p-4 bg-card rounded-lg" height="auto">
        <h1 class="font-normal text-2xl mb-16 text-center">Let's Start Something New</h1>
        <div class="flex">
            <div class="flex-1 mr-4">
                <div class="mb-4">
                    <label for="title" class="text-sm block mb-2">Title</label>
                    <input type="text" name="title" id="title" class="border border-muted p-2 text-sm block w-full rounded">
                </div>

                <div class="mb-4">
                    <label for="description" class="text-sm block mb-2">Description</label>
                    <textarea name="description" id="description" class="border border-muted p-2 text-sm block w-full rounded" rows="7"></textarea>
                </div>
            </div>
            <div class="flex-1 ml-4">
                <div class="mb-4">
                    <label class="text-sm block mb-2">Need Some Tasks?</label>
                    <input type="text" name="title" class="border border-muted p-2 text-sm block w-full rounded" placeholder="Task 1">
                </div>

                <button class="inline-flex items-center text-xs">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" class="mr-2">
                        <g fill="none" fill-rule="evenodd" opacity=".307">
                            <path stroke="#000" stroke-opacity=".012" stroke-width="0" d="M-3-3h24v24H-3z"></path>
                            <path fill="#000" d="M9 0a9 9 0 0 0-9 9c0 4.97 4.02 9 9 9A9 9 0 0 0 9 0zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm1-11H8v3H5v2h3v3h2v-3h3V8h-3V5z"></path>
                        </g>
                    </svg>
                    <span>Add New Task Field</span>
                </button>

            </div>
        </div>

        <footer class="flex justify-end">

            <button class="button-blue is-outlined mr-4">Cancel</button>
            <button class="button-blue">Create Project</button>

        </footer>

    </modal>

    <a href="" @click.prevent="$modal.show('my-first-modal')">Show Modal</a>

@endsection
