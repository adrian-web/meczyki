<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_has_articles()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->articles);
    }
}
