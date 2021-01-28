<?php

namespace Tests\Unit;

use App\Models\User;
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

}
