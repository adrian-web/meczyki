<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteArticlesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_guest_cannot_delete_an_article()
    {
        $this->withExceptionHandling();

        $article = Article::factory()->create();
        
        $this->delete("/articles/{$article->id}")->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_delete_an_article()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->delete('/articles/' . $article->id)
                ->assertRedirect('/articles/');

        // dd($article->only('id'));

        $this->assertDatabaseMissing('articles', $article->only('id'));
    }
}
