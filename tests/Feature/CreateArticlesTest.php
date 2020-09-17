<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateArticlesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_guest_cannot_create_a_new_article()
    {
        $this->withExceptionHandling();
        
        $this->get("/articles/create")->assertRedirect('/login');
        
        $this->post("/articles")->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_create_a_new_article()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->make();

        $response = $this->post('/articles', $article->toArray());

        // dd($article->id);
        // dd($response->headers->get('location'));

        $this->get($response->headers->get('location'))
                ->assertSee($article->title)
                ->assertSee($article->body);
    }

    /** @test */
    public function an_article_requires_a_title()
    {
        $this->withExceptionHandling();
        
        $this->publishArticle(['title' => null])
                ->assertSessionHasErrors('title');
    }

    /** @test */
    public function an_article_requires_a_body()
    {
        $this->withExceptionHandling();
        
        $this->publishArticle(['body' => null])
                ->assertSessionHasErrors('body');
    }

    public function publishArticle($overrides = [])
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->make($overrides);

        return $this->post('/articles', $article->toArray());
    }
}
