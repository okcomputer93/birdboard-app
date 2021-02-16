<?php

namespace Tests\Unit;

use App\Models\Projects;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_an_user()
    {
        $this->signIn();

        $project = Projects::factory()->create();

        $this->assertInstanceOf(User::class, $project->activity->first()->user);
    }

}
