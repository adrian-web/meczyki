<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticlesTest extends TestCase
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
}
