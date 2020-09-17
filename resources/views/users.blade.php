<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2>
                    <a href="/articles">Articles</a>
                    <a href="/users">Top 3</a>
                    <a href="/articles/create">Create</a>
                </h2>
                <hr>
                @foreach ($users as $user)
                <div>
                    <h4>
                        <a href="{{ '/articles/user/' . $user->id }}">{{ $user->name }}</a>
                        {{ ' wrote ' . count($user->allArticles()->get()) . ' articles'}}
                    </h4>

                    @if ( $loop->last )
                    @else
                    <hr>
                    @endif
                </div>
                @endforeach

            </div>
        </div>
    </div>
</x-guest-layout>