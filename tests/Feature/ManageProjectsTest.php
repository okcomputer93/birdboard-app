<?php

namespace Tests\Feature;

use App\Models\Projects;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->actingAs(User::factory()->create());

        $this->get('projects/create')->assertStatus(200);
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    public function an_user_can_view_their_project()
    {
        $this->actingAs(User::factory()->create());

        $project = Projects::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())->assertSee($project->title)->assertSee($project->description);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->actingAs(User::factory()->create());

        $project = Projects::factory()->create();

        $this->get($project->path())->assertStatus(403);
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

    /** @test */
    public function guests_cannot_manage_projects()
    {
        $project = Projects::factory()->create();

        $this->post('/projects', $project->toArray())->assertRedirect('login');
        $this->get('projects')->assertRedirect('login');
        $this->get('projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

}
