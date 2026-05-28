<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // ➕ IMPORT THIS FACADE
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource with optional category filtering.
     */
    public function index(Request $request) // 🔄 Injected Request payload here
    {
        // 1. Start building the query for all posts, eager loading relationships
        $postsQuery = Post::with(['user', 'category'])->orderBy('created_at', 'DESC');

        // 2. 🎯 Check if a category parameter is active in the URL query string
        if ($request->has('category')) {
            $categorySlug = $request->query('category');
            
            // Refine lookups to match the category slug
            $postsQuery->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            });
        }

        // 3. Finalize the query with simple pagination (5 items per page)
        $posts = $postsQuery->simplePaginate(5);

        // 4. Return the view with the dynamically filtered posts data
        return view("post.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all categories for the dropdown menu
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
            'title' => 'required',
            'content' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date']
        ]);

        // Separate image from other data to process it
        $image = $data['image'];
        unset($data['image']);
        // Assign the currently authenticated user's ID
        $data['user_id'] = auth()->id();
        // Generate a URL-friendly slug from the title
        $data['slug'] = Str::slug($data['title']);

        // Store the uploaded image in the 'public/posts' directory
        $imagepath = $image->store('posts', 'public');
        $data['image'] = $imagepath;

        // Create the post in the database
        Post::create($data);
        return redirect()->route('dashboard'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Bulletproof Policy Gate: Ensure user is authorized to update this post
        Gate::authorize('update', $post);

        // Fetch categories for the dropdown menu
        $categories = Category::get();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Bulletproof Policy Gate: Ensure user is authorized to update this post
        Gate::authorize('update', $post);

        // Validate incoming request data
        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
            'title' => 'required',
            'content' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date']
        ]);

        // If a new image is uploaded, store it and update the path
        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagepath;
        }

        // Regenerate slug in case the title changed
        $data['slug'] = Str::slug($data['title']);

        // Update the post in the database
        $post->update($data);

        return redirect()->route('post.show', $post->slug)
                         ->with('status', 'Article updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Bulletproof Policy Gate: Ensure user is authorized to delete this post
        Gate::authorize('delete', $post);

        // Delete the post from the database
        $post->delete();

        return redirect()->route('dashboard')
                         ->with('status', 'Article deleted successfully!');
    }
}