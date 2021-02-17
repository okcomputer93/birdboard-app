<?php

namespace Tests\Unit;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $project = Projects::factory()->create();
        $this->assertEquals(route('projects.show', $project), $project->path());
    }

    /** @test */
    public function it_belongs_to_an_owner()
    {
        $project = Projects::factory()->create();

        $this->assertInstanceOf(User::class, $project->owner);

    }

    /** @test */
    public function it_can_add_a_task()
    {
        $project = Projects::factory()->create();
        $task = $project->addTask('Test task');
        $this->assertCount(1, $project->tasks);
        $this->assertTrue($project->tasks->contains($task));

    }

    /** @test */
    public function it_can_invite_an_user()
    {
        $project = Projects::factory()->create();

        $project->invite($user = User::factory()->create());

        $this->assertTrue($project->members->contains($user));
    }



}
