<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Services\GroqService;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Moderazione AI del commento
        $groq = new GroqService();
        $isOk = $groq->moderate($request->content);
        
        if ($isOk == false) {
            return back()->withErrors(['moderation' => 'Il tuo commento viola le regole della community.']);
        }

        Comment::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'post_id' => $request->post_id
        ]);

        return back();
    }

    
}