<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;

class TopicController extends Controller
{
    public function store(Request $request)
    {
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        Topic::create([
            'title' => $request->title,
            'content' => $request->content,
            'topic_date' => $request->topic_date
        ]);

        return redirect('/');
    }

    public function history()
        {

            if (!auth()->user()->is_admin) {
                return redirect('/');
            }

            $topics = Topic::orderBy('created_at', 'desc')->get();

            return view('topics.history', compact('topics'));
        }

        public function show(Topic $topic)
        {
            if (!auth()->user()->is_admin) {
                return redirect('/');
            }

            $posts = $topic->posts()->with('comments.user', 'user')->latest()->get();

            return view('topics.show', compact('topic', 'posts'));
        }
}
