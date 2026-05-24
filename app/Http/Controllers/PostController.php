<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Topic;

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

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
            'topic_id' => $topic->id
        ]);
        return redirect('/');
    }
}