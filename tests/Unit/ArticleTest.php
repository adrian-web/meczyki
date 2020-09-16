<?php

namespace Tests\Unit;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function an_article_has_an_author()
    {
        $this->withoutExceptionHandling();
        
        $article = Article::factory()->create();

        $this->assertInstanceOf(User::class, $article->author);
    }
}
