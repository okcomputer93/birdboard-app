<?php


namespace Tests\Setup;


use App\Models\Projects;
use App\Models\Task;
use App\Models\User;

class ProjectFactory
{
    protected $taskCount = 0;
    protected $user;

    public function withTasks($count)
    {
        $this->taskCount = $count;
        return $this;

    }

    public function ownedBy($user)
    {
        $this->user = $user;
        return $this;
    }

    public function create()
    {
        $project = Projects::factory()->create([
            'owner_id' => $this->user ?? User::factory()->create()->id
        ]);

        if ($this->taskCount > 0) {
            Task::factory()->count($this->taskCount)->create([
                'projects_id' => $project->id
            ]);
        }

        return $project;

    }

}
