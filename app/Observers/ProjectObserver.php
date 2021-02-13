<?php

namespace App\Observers;

use App\Models\Projects;

class ProjectObserver
{
    /**
     * Handle the Projects "created" event.
     *
     * @param  \App\Models\Projects  $project
     * @return void
     */
    public function created(Projects $project)
    {
        $project->recordActivity('created');
    }

    /**
     * Handle the Projects "updated" event.
     *
     * @param  \App\Models\Projects  $project
     * @return void
     */
    public function updated(Projects $project)
    {
        $project->recordActivity('updated');
    }


    public function updating(Projects $project)
    {
        $project->old = $project->getOriginal();
    }

}
