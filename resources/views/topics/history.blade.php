@extends('layouts.app')

@section('content')


<h1>📚 Storico Topic</h1>

@foreach($topics as $topic)
    <div class="card" style="border:solid black 3px">
        <div class="topic-header">
            {{ $topic->title }}
        </div>

        <p>{{ $topic->content }}</p>

        <small>{{ $topic->created_at }}</small>

        <br><br>

        <a href="/topics/{{ $topic->id }}">📌 Vai al topic</a>
    </div>
@endforeach

@endsection