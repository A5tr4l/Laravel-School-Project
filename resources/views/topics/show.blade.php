@extends('layouts.app')

@section('content')

<h1>🔥 {{ $topic->title }}</h1>

<p>{{ $topic->content }}</p>

<hr>

<h2>Post</h2>

@foreach($posts as $post)
    <div class="card">

        <strong>{{ $post->user->name }}</strong>

        <p>{{ $post->content }}</p>

        <hr>

        <h4>Commenti</h4>

        @foreach($post->comments as $comment)
            <div class="comment">
                <b>{{ $comment->user->name }}</b>: {{ $comment->content }}
            </div>
        @endforeach

        <form method="POST" action="/comments">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="text" name="content" placeholder="Scrivi commento">
            <button class="btn">Commenta</button>
        </form>

    </div>
@endforeach

@endsection