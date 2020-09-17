<?php

namespace Tests\Unit;

use App\Models\Article;
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

    /** @test */
    public function a_user_may_have_shared_articles()
    {
        $this->withoutExceptionHandling();
        
        $userOne = User::factory()->create();

        Article::factory()->create(['author_id' => $userOne->id]);

        $this->assertCount(1, $userOne->allArticles()->get());

        $userTwo = User::factory()->create();
        $userThree = User::factory()->create();

        $article = Article::factory()->create(['author_id' => $userTwo->id]);
        $article->coauthors()->attach($userThree);

        $this->assertCount(1, $userOne->allArticles()->get());

        $article->coauthors()->attach($userOne);

        $this->assertCount(2, $userOne->allArticles()->get());

    }
}
