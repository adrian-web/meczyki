<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Arr;
use Tests\TestCase;

class TopAuthorsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_person_can_view_top_posting_authors()
    {
        $top = 3;
        $last = 7;

        for ($i=0; $i < $top + 1; $i++) {
            $user = User::factory()->create();

            Article::factory()->count($i+1)->create(['author_id' => $user->id]);
        }

        $users = User::get();
        $articles = Article::get();

        foreach ($articles as $article) {
            $filtered = $users->except($article->author_id);

            for ($i=0; $i < 2; $i++) {
                $article->coauthors()->attach($filtered->random());
            }
        }

        $articlesLastWeek = Article::whereBetween('created_at', [Carbon::now()->subDays($last), Carbon::now()])
                             ->get();

        $articlesSharedLastWeek = \DB::table('articles_coauthors')
                            ->whereBetween('created_at', [Carbon::now()->subDays($last), Carbon::now()])
                            ->get();
                        
        $articlesLastWeekCount = array_count_values(array_column($articlesLastWeek->toArray(), 'author_id'));
        $articlesSharedLastWeekCount = array_count_values(array_column($articlesSharedLastWeek->toArray(), 'user_id'));

        $articlesAllLastWeekCount = [];

        foreach ($articlesSharedLastWeekCount as $key => $value) {
            if (Arr::exists($articlesLastWeekCount, $key)) {
                $articlesAllLastWeekCount[$key] = $value + $articlesLastWeekCount[$key];
            } else {
                $articlesAllLastWeekCount[$key] = $value;
            }
        }

        foreach ($articlesLastWeekCount as $key => $value) {
            if (Arr::exists($articlesAllLastWeekCount, $key)) {
            } else {
                $articlesAllLastWeekCount[$key] = $value;
            }
        }

        // dd($articlesAllLastWeekCount);

        $usersTop = [];

        for ($i=0; $i < $top; $i++) {
            $value = max($articlesAllLastWeekCount);
            $key = array_search($value, $articlesAllLastWeekCount);
            $usersTop = Arr::add($usersTop, $i, $users[$key - 1]);
            Arr::pull($articlesAllLastWeekCount, $key);
        }

        $this->get('/users')
                ->assertDontSee(User::where('id', array_key_first($articlesAllLastWeekCount))->first()->name);
    }
}
