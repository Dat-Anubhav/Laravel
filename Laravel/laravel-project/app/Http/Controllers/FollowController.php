<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function toggle(Request $request, User $user): JsonResponse|RedirectResponse
    {
        if (! auth()->check()) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Unauthenticated.'], 401)
                : redirect()->route('login');
        }

        if (auth()->id() === $user->id) {
            return $request->expectsJson()
                ? response()->json(['message' => 'Cannot follow yourself.'], 422)
                : back();
        }

        $result = auth()->user()->followings()->toggle($user->id);
        $following = in_array($user->id, $result['attached'], true);

        $payload = [
            'following' => $following,
            'followers_count' => $user->followers()->count(),
        ];

        return $request->expectsJson()
            ? response()->json($payload)
            : back();
    }
}
