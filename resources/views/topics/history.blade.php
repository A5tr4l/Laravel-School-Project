@extends('layouts.app')

@section('content')


<h1>📚 Storico Topic</h1>

@foreach($topics as $topic)
    <div class="card">
        <div class="topic-header">
            {{ $topic->title }}
        </div>

        <p>{{ $topic->content }}</p>

        <small>📅 {{ \Carbon\Carbon::parse($topic->topic_date)->translatedFormat('d F Y') }}</small>

        <br><br>

        <a href="/topics/{{ $topic->id }}">📌 Vai al topic</a>
    </div>
@endforeach

@endsection