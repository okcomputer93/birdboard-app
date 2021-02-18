<?php

namespace Tests\Unit;

use App\Models\User;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
   public function has_projects()
   {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->projects);
   }

   /** @test */
   public function an_user_has_accessible_projects()
   {
       $jon = $this->signIn();

       ProjectFactory::ownedBy($jon)->create();

       $this->assertCount(1, $jon->accessibleProjects());

       $sally = User::factory()->create();
       $nick = User::factory()->create();

       $project = tap(ProjectFactory::ownedBy($sally)->create())->invite($nick);

       $this->assertCount(1, $jon->accessibleProjects());

       $project->invite($jon);
       $this->assertCount(2, $jon->accessibleProjects());
   }


}
