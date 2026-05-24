<h1>Benvenuto {{ auth()->user()->name }}</h1>

<h2>📌 Topic del giorno</h2>

@if(auth()->user()->is_admin)

<h3>Crea Topic del giorno</h3>

<form method="POST" action="/topics">
    @csrf
    <input type="text" name="title" placeholder="Titolo topic">
    <textarea name="content" placeholder="Descrizione"></textarea>
    <input type="date" name="topic_date">
    <button>Crea topic</button>
</form>

@endif

@if($topic)
    <div style="padding:10px; border:1px solid black; margin-bottom:20px;">
        <strong>{{ $topic->title }}</strong>
        <p>{{ $topic->content }}</p>
    </div>
@else
    <p>Nessun topic disponibile</p>
@endif

<form method="POST" action="/posts">
    @csrf
    <input type="text" name="title" placeholder="Titolo">
    <textarea name="content" placeholder="Scrivi un post..."></textarea>
    <button>Pubblica</button>
</form>

<hr>

@foreach($posts as $post)
    <div style="border:1px solid #ccc; margin:10px; padding:10px;">
        <b>{{ $post->title }}</b>
        <p>{{ $post->content }}</p>
        <small>Autore: {{ $post->user->name }}</small>
        <form method="POST" action="/comments">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="text" name="content" placeholder="Scrivi un commento">
        <button>Invia</button>
    </form>

    @foreach($post->comments as $comment)
        <p><strong>{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>
    @endforeach
    </div>
@endforeach

<form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-btn">Logout</button>
            </form>