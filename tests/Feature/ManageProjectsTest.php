<?php

namespace Tests\Feature;

use App\Models\Projects;
use App\Models\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function an_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $this->get('projects/create')->assertStatus(200);
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'notes' => 'General notes here'
        ];

        $response = $this->post('/projects', $attributes);

        $project = Projects::where($attributes)->first();

        $response->assertRedirect($project->path());

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function an_user_can_see_all_projects_they_have_been_invited_to_on_their_dashboards()
    {
        $project = tap(ProjectFactory::create())->invite($this->signIn());

        $this->get('/projects')->assertSee($project->title);
    }

    /** @test */
    public function unauthorized_users_cannot_delete_projects()
    {
        $project = ProjectFactory::create();

        $this->delete($project->path())
            ->assertRedirect('/login');

        $this->signIn();

        $this->delete($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function an_user_can_delete_a_project()
    {
        $this->withoutExceptionHandling();

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');

        $this->assertDatabaseMissing('projects', $project->only('id'));

    }


    /** @test */
    public function an_user_can_update_a_project()
    {
        $this->withoutExceptionHandling();
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'title' => 'Changed',
                'description' => 'Changed',
                'notes' => 'Changed'
            ])->assertRedirect($project->path());

        $this->actingAs($project->owner)->get($project->path() . '/edit')->assertStatus(200);

        $this->assertDatabaseHas('projects', $attributes);
    }

    /** @test */
    public function an_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = [
                'notes' => 'Changed'
            ]);

        $this->assertDatabaseHas('projects', $attributes);
    }


    /** @test */
    public function an_user_can_view_their_project()
    {
        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee(Str::limit($project->title, 100))
            ->assertSee(Str::limit($project->description, 100));
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->get($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signIn();

        $project = ProjectFactory::create();

        $this->patch($project->path())->assertStatus(403);
    }


    /** @test */
    public function a_project_requires_a_title()
    {
        $this->signIn();
        $attributes = Projects::factory()->raw([
            'title' => ''
        ]);
        $this->post('/projects', $attributes)->assertSessionHasErrors();
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->signIn();

        $attributes = Projects::factory()->raw([
            'description' => ''
        ]);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function only_authenticated_users_can_create_projects()
    {
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
        $this->get($project->path() . '/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
    }

}
