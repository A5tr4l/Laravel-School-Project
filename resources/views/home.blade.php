@extends('layouts.app')

@section('content')

<h1>Benvenuto {{ auth()->user()->name }}</h1>

<h2>📌 Topic del giorno</h2>

@if(auth()->user()->is_admin)

<h3>Crea Topic del giorno</h3>

<form method="POST" action="/topics">
    @csrf
    <input type="text" name="title" placeholder="Titolo topic">
    <textarea name="content" placeholder="Descrizione"></textarea>
    
    <button>Crea topic</button>
</form>

@endif

@if($topic)
    <div class="topic-card">
        <strong>{{ $topic->title }}</strong>
        <p>{{ $topic->content }}</p>
    </div>
@else
    <p class="empty-state">Nessun topic disponibile</p>
@endif

<h3>Scrivi un post</h3>

<form method="POST" action="/posts">
    @csrf
    <input type="text" name="title" placeholder="Titolo">
    <textarea name="content" placeholder="Scrivi un post..."></textarea>
    <button>Pubblica</button>
</form>

<hr>

@foreach($posts as $post)
@if ($post->topic_id === $topic->id)

    <div class="post-card">
        <b>{{ $post->title }}</b>
        <p>{{ $post->content }}</p>
        <span class="post-meta">Autore: {{ $post->user->name }}</span>

        <form method="POST" action="/comments" class="comment-form">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <input type="text" name="content" placeholder="Scrivi un commento">
            <button>Invia</button>
        </form>

        @foreach($post->comments as $comment)
            <div class="comment">
                <b>{{ $comment->user->name }}</b>: {{ $comment->content }}
            </div>
        @endforeach
    </div>
    @endif
    @endforeach

@endsection