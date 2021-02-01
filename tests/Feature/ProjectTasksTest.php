<?php

namespace Tests\Feature;

use App\Models\Projects;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
   use RefreshDatabase;
    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();
        $project = Projects::factory()->create();
        $this->post($project->path() .'/tasks', ['body' => 'Test task'])
            ->assertStatus(403);
        $this->assertDatabaseMissing('tasks', ['body' => 'Test task']);

    }

   /** @test */
   public function a_project_can_have_tasks()
   {
       $this->withoutExceptionHandling();
       $this->signIn();
       $project = auth()->user()->projects()->create(Projects::factory()->raw());
       $this->post($project->path() .'/tasks', ['body' => 'Test task']);

       $this->get($project->path())->assertSee('Test task');

   }


   /** @test */
   public function a_task_requires_body()
   {
       $this->signIn();

       $project = auth()->user()->projects()->create(Projects::factory()->raw());

       $task = Task::factory()->raw([
           'body' => ''
       ]);
       $this->post($project->path() . '/tasks', $task)->assertSessionHasErrors('body');
   }


}
