<?php

namespace App\Policies;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectsPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Projects $project)
    {
         return $user->is($project->owner) || $project->members->contains($user);
    }

    public function manage(User $user, Projects $project)
    {
        return $user->is($project->owner);
    }
}
