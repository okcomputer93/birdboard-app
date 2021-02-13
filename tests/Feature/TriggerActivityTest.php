<?php

namespace Tests\Feature;

use App\Models\Task;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TriggerActivityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function creating_a_project()
    {
        $project = ProjectFactory::create();
        $this->assertCount(1, $project->activity);
        $this->assertEquals('created', $project->activity->first()->description);
    }

    /** @test */
    public function updating_a_project()
    {
        $project = ProjectFactory::create();
        $originalTitle = $project->title;
        $project->update(['title' => 'changed']);
        $this->assertCount(2, $project->activity);
        tap($project->activity->last(), function ($activity) use ($originalTitle) {
            $this->assertEquals('updated', $activity->description);

            $expected = [
                'before' => ['title' => $originalTitle],
                'after' => ['title' => 'changed']
            ];
            $this->assertEquals($expected, $activity->changes);
        });
    }

    /** @test */
    public function creating_a_new_task()
    {
        $project = ProjectFactory::create();
        $project->addTask('Some task');
        $this->assertCount(2, $project->activity);

        tap($project->activity->last(), function ($activity) {
            $this->assertEquals('created_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
            $this->assertEquals('Some task', $activity->subject->body);
        });

    }

    /** @test */
    public function completing_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);
        $this->assertCount(3, $project->activity);

        tap($project->activity->last(), function ($activity) {
            $this->assertEquals('completed_task', $activity->description);
            $this->assertInstanceOf(Task::class, $activity->subject);
        });

    }

    /** @test */
    public function incompleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();
        $this->actingAs($project->owner)
            ->patch($project->tasks->first()->path(), [
                'body' => 'foobar',
                'completed' => true
            ]);
        $this->assertCount(3, $project->activity);

        $this->patch($project->tasks->first()->path(), [
                'body' => 'foobar',
                'completed' => false
            ]);

        $this->assertCount(4, $project->refresh()->activity);

        $this->assertEquals('incomplete_task', $project->activity->last()->description);
    }

    /** @test */
    public function deleting_a_task()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $project->tasks->first()->delete();

        $this->assertCount(3, $project->refresh()->activity);
    }








}
