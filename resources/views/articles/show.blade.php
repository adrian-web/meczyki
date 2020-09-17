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

                    <form action="{{ '/articles/' . $article->id }}" method="POST">
                        @method('DELETE')
                        @csrf

                        <x-jet-button>
                            {{ __('Delete') }}
                        </x-jet-button>
                    </form>

                    <div class="font-semibold text-xl text-gray-800 leading-tight mt-3">
                        <a href="{{ '/articles/' . $article->id . '/edit' }}">Edit</a>
                    </div>

                    <div class="mt-3"></div>
                    <hr>

                    <article>
                        <h4 class="mt-8 text-2xl">{{ $article->title }}</h4>
                        <div class="mt-6 text-gray-500">{{ $article->body }}</div>
                    </article>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>