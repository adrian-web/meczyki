<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="/articles" class="mr-5">Articles</a>
            <a href="/users" class="mr-5">Top 3</a>
            <a href="/articles/create" class="mr-5">Create</a>
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">


                    @foreach ($articles as $article)
                    <article>
                        <h4 class="mt-6 text-gray-500">
                            <a href="{{ '/articles/user/' . $article->author->id }}">{{ $article->author->name }}</a>
                            {{ ' wrote ' . $article->created_at->diffForHumans() }}

                            @if ($article->coauthors->isNotEmpty())
                            {{ ', coauthors: ' }}
                            @foreach ($article->coauthors->pluck('name')->all() as $coauthor)
                            @if ( $loop->first )
                            {{ $coauthor }}
                            @else
                            {{ ', ' . $coauthor }}
                            @endif
                            @endforeach
                            @endif


                        </h4>
                        <h4 class="mt-8 text-2xl">
                            <a href="{{ '/articles/' . $article->id }}">{{ $article->title }}</a>
                        </h4>
                        <div class="mt-6 text-gray-500">{{ $article->body }}</div>

                        <div class="mt-6"></div>
                        @if ( $loop->last )
                        @else
                        <hr>
                        @endif
                    </article>
                    @endforeach

                    {{ $articles->links() }}

                </div>
            </div>
        </div>
    </div>

</x-app-layout>