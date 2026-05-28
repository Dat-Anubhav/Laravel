<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function toggle(Post $post): RedirectResponse
    {
        // Automatically adds or removes the record from the pivot table
        auth()->user()->likedPosts()->toggle($post->id);

        return back();
    }
}