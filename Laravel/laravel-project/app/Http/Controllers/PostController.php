<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use App\Services\ImageService;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(
        private ImageService $images
    ) {}

    public function index(Request $request)
    {
        $postsQuery = Post::with(['user', 'category'])
            ->withCount(['likes', 'comments'])
            ->orderByDesc('created_at');

        if ($request->query('feed') === 'following') {
            $followedUserIds = auth()->user()
                ->followings()
                ->pluck('leader_id')
                ->toArray();

            $postsQuery->whereIn('user_id', $followedUserIds);
        }

        if ($request->has('category')) {
            $categorySlug = $request->query('category');

            $postsQuery->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }

        $posts = $postsQuery->simplePaginate(5);
        $likedPostIds = $this->likedPostIdsFor($posts);

        return view('post.index', compact('posts', 'likedPostIds'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
            'title' => 'required',
            'content' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data['image'] = $this->storeOptimizedImage($request->file('image'), $data['title']);
        $data['user_id'] = auth()->id();
        $data['slug'] = $this->uniqueSlug($data['title']);

        Post::create($data);

        return redirect()->route('dashboard');
    }

    public function show(Post $post)
    {
        $post->load(['comments.user', 'user', 'category'])
            ->loadCount(['likes', 'comments']);

        $likedPostIds = auth()->check()
            ? auth()->user()->likedPosts()->where('posts.id', $post->id)->pluck('posts.id')
            : collect();

        return view('post.show', compact('post', 'likedPostIds'));
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        $categories = Category::orderBy('name')->get();

        return view('post.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        Gate::authorize('update', $post);

        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
            'title' => 'required',
            'content' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeOptimizedImage($request->file('image'), $data['title']);
        }

        $data['slug'] = $this->uniqueSlug($data['title'], $post->id);

        $post->update($data);

        return redirect()
            ->route('post.show', $post->slug)
            ->with('status', 'Article updated successfully!');
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'Article deleted successfully!');
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

    private function storeOptimizedImage($imageFile, string $title): string
    {
        $filename = time().'_'.Str::slug($title).'.'.$imageFile->getClientOriginalExtension();
        $destinationPath = storage_path('app/public/posts');

        if (! file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $absolutePath = $destinationPath.'/'.$filename;

        $this->images->savePostCover($imageFile, $absolutePath);

        return 'posts/'.$filename;
    }

    private function uniqueSlug(string $title, ?int $ignorePostId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;

        while (
            Post::where('slug', $slug)
                ->when($ignorePostId, fn ($query) => $query->where('id', '!=', $ignorePostId))
                ->exists()
        ) {
            $slug = $original.'-'.$counter;
            $counter++;
        }

        return $slug;
    }
}
