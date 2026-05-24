@extends('layouts.app')

@section('content')

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
    <h2>Risultati della ricerca</h2>
    <a href="/" class="btn">Torna alla Home</a>
</div>

<div class="search-box">
    Hai cercato: <strong>"{{ $query }}"</strong>
</div>

@if($posts->isEmpty())
    <p class="empty-state">L'Intelligenza Artificiale non ha trovato nessun post con questo significato.</p>
@else
    <p style="margin-bottom: 1.5rem; color: #4b5563;">L'AI ha trovato <strong>{{ $posts->count() }}</strong> post pertinenti alla tua ricerca:</p>

    @foreach($posts as $post)
        <div class="post-card">
            <b>{{ $post->title }}</b>
            <p>{{ $post->content }}</p>
            <span class="post-meta">Autore: {{ $post->user->name }} | Nel topic: {{ $post->topic->title ?? 'Sconosciuto' }}</span>
        </div>
    @endforeach
@endif

@endsection
