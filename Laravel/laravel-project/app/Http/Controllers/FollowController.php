<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;

class FollowController extends Controller
{
    public function toggle(User $user): RedirectResponse
    {
        // Prevent users from following themselves
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        auth()->user()->followings()->toggle($user->id);

        return back();
    }
}