@extends ('layouts.app')
@section('content')
    <header class="flex items-end justify-between mb-3 py-4">
        <h2 class="text-muted text-sm font-normal">My Projects</h2>
        <a class="button-blue cursor-pointer" @click.prevent="$modal.show('new-project')">New Project</a>
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

    <new-project></new-project>

@endsection
