    @csrf
    <div class="field">
        <label for="title" class="text-xl">Title</label>
        <div class="mb-10 mt-2">
            <input type="text"
                   class="border-solid border-2 border-grey-light focus:outline-none rounded focus:border-blue-light w-full p-2 text-sm"
                   id="title"
                   name="title"
                   placeholder="My next awesome project"
                   required
                   value="{{ $project->title }}"
            >
            @error('title')
             <p class="text-xs text-red-700 relative mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <label for="description" class="text-xl">Description</label>

        <div class="mb-10 mt-2">
            <textarea
                    rows="10"
                    class="border-solid border-2 border-grey-light focus:outline-none rounded focus:border-blue-light p-2 w-full text-sm"
                    id="description"
                    name="description"
                    required
                    placeholder="Your description goes here."
            >{{ $project->description }}</textarea>
            @error('description')
                <p class="text-xs text-red-700 relative mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="field">
        <div class="control">
            <button class="button-blue" type="submit">{{ $project->exists ? 'Update' : 'Create' }} Project</button>
            <a class="ml-3" href="{{  $project->exists ? $project->path() : '/projects'  }}">Cancel</a>
        </div>
    </div>
