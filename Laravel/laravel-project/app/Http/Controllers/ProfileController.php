<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display the public author profile page with optional category filtering.
     */
    public function show(Request $request, string $username): \Illuminate\View\View
    {
        // 1. Find the user in the database using their unique username
        $user = \App\Models\User::where('username', $username)->firstOrFail();

        // 2. Start building the query for this user's posts relationship
        $postsQuery = $user->posts()->orderBy('created_at', 'desc');

        // 3. Check if a specific category parameter exists in the incoming URL query string
        if ($request->has('category')) {
            $categorySlug = $request->query('category');
            
            // Refine the posts lookup to match the given category slug relation
            $postsQuery->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }

        // 4. Finalize the query with simple pagination (5 records per page)
        $posts = $postsQuery->simplePaginate(5);

        // 5. Pass both the user and their dynamically filtered posts into our layout file
        return view('profile.show', compact('user', 'posts'));
    }
}
