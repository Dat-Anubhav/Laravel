<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // 1. Validate the text input field
        $request->validate([
            'body' => ['required', 'string', 'max:1000']
        ]);

        // 2. Create the comment row via the Post relationship
        $post->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        // 3. Bounce back to the post page with a success toast notification
        return back()->with('status', 'Comment added successfully!');
    }
}