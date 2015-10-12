@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            @foreach($articles as $article)
            <div class="post-preview">
                <a href="{{ route('articles.show', ['slug' => $article->slug]) }}">
                    <h2 class="post-title">
                        {{ $article->title }}
                    </h2>
                    <h3 class="post-subtitle">
                        {{ $article->description }}
                    </h3>
                </a>
                <p class="post-meta">Posted by <a href="{{ route('contact.index') }}">{{ $article->author->name }}</a> on {{ $article->published_at_formatted }}</p>
            </div>
            @endforeach
            <hr>
            <!-- Pager -->
            <ul class="pager">            
                @if($articles->previousPageUrl())
                    <li class="previous">
                        <a href="{{ $articles->previousPageUrl() }}">&larr; Newer Posts</a>
                    </li>
                @else            
                    <li class="previous disabled">
                        <a href="#">&larr; Newer Posts</a>
                    </li>
                @endif
                @if($articles->nextPageUrl())
                    <li class="next">
                        <a href="{{ $articles->nextPageUrl() }}">Older Posts &rarr;</a>
                    </li>
                @else            
                    <li class="next disabled">
                        <a href="#">Older Posts &rarr;</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
@stop
