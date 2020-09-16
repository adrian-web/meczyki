<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2>
                    <a href="/articles">Articles</a>
                    <a href="/users">Top 3 Users</a>
                </h2>
                <hr>

                <article>
                    <h4>{{ $article->title }}</h4>
                    <div>{{ $article->body }}</div>
                </article>


            </div>
        </div>
    </div>
</x-guest-layout>