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

}
