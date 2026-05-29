<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowController extends Controller
{
    /**
     * Toggle the follow status for a specified user using traditional redirect back.
     */
    public function toggle(User $user)
    {
        // 1. Redirect guests straight to login
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // 2. Prevent self-following anomalies
        if (auth()->id() === $user->id) {
            return back();
        }

        // 3. Perform the tracking toggle step against relations table
        auth()->user()->followings()->toggle($user->id);

        // 4. Return page redirect back to the view state
        return back();
    }
}