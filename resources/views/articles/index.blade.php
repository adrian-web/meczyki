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

                @foreach ($articles as $article)
                <article>
                    <h4>
                        <a href="{{ '/articles/user/' . $article->author->id }}">{{ $article->author->name }}</a>
                        {{ ' wrote ' . $article->created_at->diffForHumans() }}
                    </h4>
                    <h4>
                        <a href="{{ '/articles/' . $article->id }}">{{ $article->title }}</a>
                    </h4>
                    <div>{{ $article->body }}</div>
                    @if ( $loop->last )
                    <div class="mt-3"></div>
                    @else
                    <hr>
                    @endif
                </article>
                @endforeach

                {{ $articles->links() }}

            </div>
        </div>
    </div>
</x-guest-layout>