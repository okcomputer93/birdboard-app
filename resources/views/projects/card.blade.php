
<div class="card flex flex-col" style="height: 200px">
    <h3 class="font-normal text-xl py-4 mb-3 -ml-5 border-l-4 border-blue-light pl-4">
        <a class="text-black no-underline" href="{{ $project->path() }}">{{ $project->title }}</a>
    </h3>
    <div class="text-grey-font text-lg mb-4 flex-1">{{ Str::limit($project->description, 100) }}</div>

    <footer>
        <form method="post" action="{{ $project->path() }}" class="text-right">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-xs hover:text-red-500">Delete</button>
        </form>
    </footer>
</div>
