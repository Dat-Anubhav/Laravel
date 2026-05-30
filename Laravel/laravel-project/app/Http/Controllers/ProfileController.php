<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use App\Services\ImageService;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct(
        private ImageService $images
    ) {}

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->safe()->except(['image', 'remove_image']));

        if ($request->boolean('remove_image')) {
            $this->deleteAvatar($user);
            $user->image = null;
        } elseif ($request->hasFile('image')) {
            $this->deleteAvatar($user);
            $user->image = $this->storeAvatar($request->file('image'), $request->username);
        }

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

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

    public function show(Request $request, string $username): View
    {
        $user = User::where('username', $username)
            ->withCount(['followers', 'followings'])
            ->firstOrFail();

        $postsQuery = $user->posts()
            ->with(['category', 'user'])
            ->withCount(['likes', 'comments'])
            ->orderByDesc('created_at');

        if ($request->has('category')) {
            $categorySlug = $request->query('category');

            $postsQuery->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }

        $posts = $postsQuery->simplePaginate(5);
        $likedPostIds = $this->likedPostIdsFor($posts);

        $isFollowing = auth()->check()
            && auth()->id() !== $user->id
            && auth()->user()->followings()->where('leader_id', $user->id)->exists();

        return view('profile.show', compact('user', 'posts', 'likedPostIds', 'isFollowing'));
    }

    private function likedPostIdsFor($posts): Collection
    {
        if (! auth()->check() || $posts->isEmpty()) {
            return collect();
        }

        return auth()->user()
            ->likedPosts()
            ->whereIn('posts.id', $posts->pluck('id'))
            ->pluck('posts.id');
    }

    private function deleteAvatar(User $user): void
    {
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }
    }

    private function storeAvatar($imageFile, string $username): string
    {
        $filename = time().'_'.Str::slug($username).'.jpg';
        $destinationPath = storage_path('app/public/avatars');

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $absolutePath = $destinationPath.'/'.$filename;

        $this->images->saveAvatar($imageFile, $absolutePath);

        return 'avatars/'.$filename;
    }
}
