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
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->simplePaginate(5);
        return view("post.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
            'title' => 'required',
            'content' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date']
        ]);

        $image = $data['image'];
        unset($data['image']);
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);

        $imagepath = $image->store('posts', 'public');
        $data['image'] = $imagepath;

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
        // Bulletproof Policy Gate
        Gate::authorize('update', $post);

        $categories = Category::get();
        return view('post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Bulletproof Policy Gate
        Gate::authorize('update', $post);

        $data = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif,svg', 'max:2048'],
            'title' => 'required',
            'content' => 'required',
            'category_id' => ['required', 'exists:categories,id'],
            'published_at' => ['nullable', 'date']
        ]);

        if ($request->hasFile('image')) {
            $imagepath = $request->file('image')->store('posts', 'public');
            $data['image'] = $imagepath;
        }

        $data['slug'] = Str::slug($data['title']);

        $post->update($data);

        return redirect()->route('post.show', $post->slug)
                         ->with('status', 'Article updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Bulletproof Policy Gate
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('dashboard')
                         ->with('status', 'Article deleted successfully!');
    }
}