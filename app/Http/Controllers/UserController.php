<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top = 3;
        $last = 7;

        $users = User::get();

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

        $usersTop = [];

        for ($i=0; $i < $top; $i++) {
            $value = max($articlesAllLastWeekCount);
            $key = array_search($value, $articlesAllLastWeekCount);
            $usersTop = Arr::add($usersTop, $i, $users[$key - 1]);
            Arr::pull($articlesAllLastWeekCount, $key);
        }

        return view('users', ['users' => $usersTop]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
