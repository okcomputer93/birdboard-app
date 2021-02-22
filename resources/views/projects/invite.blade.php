<div class="card flex flex-col mt-3">
    <h3 class="font-normal text-xl text-default py-4 mb-3 -ml-5 border-l-4 border-blue-light pl-4">
        Invite a User
    </h3>

    <form method="post" action="{{ $project->path() . '/invitations' }}">
        @csrf
        <div class="mb-3">
            <input class="card border-solid border-2 border-border focus:outline-none focus:border-border-focus rounded rounded w-full py-2 px-3"
                   type="email" name="email" id="email" placeholder="Email address">
        </div>
        <button type="submit" class="button-blue text-xs">Invite</button>
        @error('email')
        <li class="text-sm text-red-700 pt-3 list-none">{{ $message }}</li>
        @enderror
    </form>
</div>
