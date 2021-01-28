<?php

namespace Tests\Feature;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function an_user_can_view_a_project()
    {
        $this->actingAs(User::factory()->create());
        $project = Projects::factory()->create();
        $this->get($project->path())->assertSee($project->title)->assertSee($project->description);
    }


    /** @test */
    public function a_project_requires_a_title()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Projects::factory()->raw([
            'title' => ''
        ]);
        $this->post('/projects', $attributes)->assertSessionHasErrors();
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->actingAs(User::factory()->create());
        $attributes = Projects::factory()->raw([
            'description' => ''
        ]);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function only_authenticated_users_can_create_projects()
    {
//        $this->withoutExceptionHandling();
        $attributes = Projects::factory()->raw([
            'owner_id' => null
        ]);
        $this->post('/projects', $attributes)->assertRedirect('login');
    }





}
