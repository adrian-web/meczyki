<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditArticlesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_guest_cannot_edit_an_article()
    {
        $this->withExceptionHandling();

        $article = Article::factory()->create();
        
        $this->get("/articles/{$article->id}/edit")->assertRedirect('/login');
        
        $this->patch("/articles/{$article->id}")->assertRedirect('/login');
    }

    /** @test */
    public function a_user_can_update_an_article()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->patch('/articles/' . $article->id, $attributes = ['title' => 'changed', 'body' => 'changed'])
                ->assertRedirect('/articles/' . $article->id);

        $this->assertDatabaseHas('articles', $attributes);
    }
}
