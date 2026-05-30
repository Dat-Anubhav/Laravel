<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggle(Request $request, Post $post): JsonResponse|RedirectResponse
    {
        if (! auth()->check()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthenticated.'], 401)
                : redirect()->route('login');
        }

        $result = auth()->user()->likedPosts()->toggle($post->id);
        $liked = in_array($post->id, $result['attached'], true);

        $payload = [
            'liked' => $liked,
            'likes_count' => $post->likes()->count(),
        ];

        return $request->expectsJson()
            ? response()->json($payload)
            : back();
    }
}
