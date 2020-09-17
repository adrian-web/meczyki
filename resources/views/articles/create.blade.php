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

                @if (auth()->check())

                <form action="/articles" method="POST">
                    @csrf
                    <div>
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title">
                    </div>

                    <div>
                        <label for=" body">Body:</label>
                        <textarea name="body" id="body" cols="30" rows="10"></textarea>
                    </div>

                    <button type="submit" class="button">Publish</button>
                </form>
                @else
                <a href="{{ route('login') }}">Please sign in...</a>

                @endif
            </div>
        </div>
    </div>
</x-guest-layout>