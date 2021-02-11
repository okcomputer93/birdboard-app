<?php

namespace App\Observers;

use App\Models\Activity;
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
        $this->recordActivity($project, 'created');
    }

    /**
     * Handle the Projects "updated" event.
     *
     * @param  \App\Models\Projects  $project
     * @return void
     */
    public function updated(Projects $project)
    {
        $this->recordActivity($project, 'updated');
    }

    protected function recordActivity($project, $type)
    {
        Activity::create([
            'project_id' => $project->id,
            'description' => $type
        ]);
    }
}
