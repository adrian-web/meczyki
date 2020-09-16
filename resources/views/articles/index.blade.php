@foreach ($articles as $article)
<article>
    <h2>
        <a href="{{ '/articles/' . $article->id }}">{{ $article->title }}</a>
    </h2>
    <div>{{ $article->body }}</div>
    @if ( $loop->last )
    @else
    <hr>
    @endif
</article>
@endforeach