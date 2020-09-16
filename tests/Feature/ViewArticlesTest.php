<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewArticlesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_person_can_view_all_articles()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        $response = $this->get('/articles');

        $response->assertSee($article->title);
    }

    /** @test */
    public function a_person_can_view_a_single_article()
    {
        $this->withoutExceptionHandling();

        $article = Article::factory()->create();

        $response = $this->get('/articles/' . $article->id);

        $response->assertSee($article->title);
    }

    /** @test */
    public function a_person_can_view_articles_from_a_given_author()
    {
        $this->withoutExceptionHandling();
        
        $user = User::factory()->create();

        $articleGivenAuthor = Article::factory()->create(['author_id' => $user->id]);
        $articleRandomAuthor = Article::factory()->create();

        $this->get('/articles/user/' . $user->id)
                ->assertSee($articleGivenAuthor->title)
                ->assertDontSee($articleRandomAuthor->title);
    }
}
