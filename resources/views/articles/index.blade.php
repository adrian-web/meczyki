<h2>
    <a href="/articles">Articles</a>
    <hr>
</h2>

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
    @else
    <hr>
    @endif
</article>
@endforeach

{{ $articles->links() }}