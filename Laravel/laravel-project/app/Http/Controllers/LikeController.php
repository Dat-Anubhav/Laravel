<?php

namespace App\Http\Controllers;

use App\Models\Post;

class LikeController extends Controller
{
    /**
     * Toggle liking status for a post using traditional redirect back.
     */
    public function toggle(Post $post)
    {
        // 1. Redirect guests straight to login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        // 2. Perform the traditional toggle action inside the pivot mapping
        $user->likedPosts()->toggle($post->id);

        // 3. Return page redirect back to the user view state
        return back();
    }
}