<?php

namespace Tests\Unit;

use App\Models\Projects;
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
}
