<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Arr;

class TopAuthorsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_person_can_view_top_posting_authors()
    {
        $top = 3;
        $usersArticles = [];

        for ($i=0; $i < $top + 1; $i++) {
            $user = User::factory()->create();

            Article::factory()->count($i+1)->create(['author_id' => $user->id]);
           
            $usersArticles = Arr::add($usersArticles, $user->id, count($user->articles));
        }

        $value = min($usersArticles);
        $key = array_search($value, $usersArticles);

        $this->get('/users')
                ->assertDontSee(User::where('id', $key)->first()->name);
    }
}
