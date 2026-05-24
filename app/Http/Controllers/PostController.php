<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;
use App\Services\GroqService;

class PostController extends Controller
{
    public function index()
        {
            $posts = Post::with('user', 'topic')->latest()->get();
            $topic = Topic::latest()->first();

            return view('home', compact('posts', 'topic'));
        }

    public function store(Request $request)
    {
        $topic = Topic::latest()->first();

        if (!$topic) {
            return back()->withErrors(['topic' => 'Nessun topic disponibile']);
        }

        // Moderazione AI prima di salvare
        $groq = new GroqService();
        $textToCheck = $request->title . " " . $request->content;
        
        $isOk = $groq->moderate($textToCheck);
        
        if ($isOk == false) {
            return back()->withErrors(['moderation' => 'Il tuo post viola le regole della community (insulti, spam o contenuti inappropriati).']);
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
            'topic_id' => $topic->id
        ]);
        return redirect('/');
    }

    // Nuova funzione per la ricerca intelligente
    public function search(Request $request)
    {
        $query = $request->input('q'); // Prende la ricerca dell'utente

        // Se l'utente non ha scritto nulla, torniamo alla home
        if (empty($query)) {
            return redirect('/');
        }

        // Prendiamo tutti i post
        $allPosts = Post::with('user', 'topic')->get();

        // Usiamo l'intelligenza artificiale per trovare quelli giusti
        $groq = new GroqService();
        $matchingIds = $groq->semanticSearch($query, $allPosts);

        // Se l'AI ha trovato qualcosa, prendiamo quei post specifici
        if (count($matchingIds) > 0) {
            // whereIn cerca i post che hanno l'id dentro la nostra lista matchingIds
            $posts = Post::with('user', 'topic')->whereIn('id', $matchingIds)->get();
        } else {
            // Nessun post trovato
            $posts = collect(); // Lista vuota
        }

        // Mostriamo la pagina dei risultati
        return view('search', ['posts' => $posts, 'query' => $query]);
    }
}