<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()
                ->count(10)
                ->create();

        foreach ($users as $user) {
            Article::factory()
                        ->times(rand(1, 9))
                        ->create(['author_id' => $user->id]);
        }

        $articles = Article::get();

        foreach ($articles as $article) {
            $filtered = $users->except($article->author_id);

            for ($i=0; $i < rand(1, 3); $i++) {
                $article->coauthors()->attach($filtered->random());
            }
        }
    }
}
