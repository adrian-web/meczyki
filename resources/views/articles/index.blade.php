@foreach ($articles as $article)
<article>
    <a href="#">{{ $article->title }}</a>
    <div>{{ $article->body }}</div>
    <hr>
</article>
@endforeach