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

    /** @test */
    public function an_article_may_have_a_coauthor()
    {
        $this->withoutExceptionHandling();
        
        $article = Article::factory()->create();

        $user = User::factory()->create();

        $article->coauthors()->attach($user);

        $this->assertCount(1, $article->coauthors);
        $this->assertInstanceOf(User::class, $article->coauthors()->first());
    }
}
