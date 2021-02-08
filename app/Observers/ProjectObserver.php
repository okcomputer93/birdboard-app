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
        Activity::create([
            'project_id' => $project->id,
            'description' => 'created'
        ]);
    }

    /**
     * Handle the Projects "updated" event.
     *
     * @param  \App\Models\Projects  $project
     * @return void
     */
    public function updated(Projects $project)
    {
        Activity::create([
            'project_id' => $project->id,
            'description' => 'updated'
        ]);
    }

    /**
     * Handle the Projects "deleted" event.
     *
     * @param  \App\Models\Projects  $project
     * @return void
     */
    public function deleted(Projects $project)
    {
        //
    }

    /**
     * Handle the Projects "restored" event.
     *
     * @param  \App\Models\Projects  $project
     * @return void
     */
    public function restored(Projects $project)
    {
        //
    }

    /**
     * Handle the Projects "force deleted" event.
     *
     * @param  \App\Models\Projects  $project
     * @return void
     */
    public function forceDeleted(Projects $project)
    {
        //
    }
}
