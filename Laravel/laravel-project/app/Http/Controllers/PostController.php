<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Str;
use Symfony\Contracts\Service\Attribute\Required;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $posts=Post::orderBy('created_at', 'DESC')->simplePaginate(5);
        //dd($posts);/*In Laravel, the dd() function stands for Dump and Die.It is a helper function used mainly for debugging*/

        return view("post.index",compact("posts"));//compact() is a method to pass a data or variable
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get();
        return view('post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'image'=>['required', 'image','mimes:jpeg,jpg,png,gif,svg','max:2048'],
            'title'=>'required',
            'content'=>'required',
            'category_id'=>['required', 'exists:categories,id'],
            'published_at'=>['nullable','date']]);

            $image=$data['image'];// 1. Temporarily save the uploaded file object into $image
            unset($data['image']);// 2. Remove the file object from the $data array (you can't save a raw file object textually in SQL)
            $data['user_id'] = auth()->id();// 3. Grab the ID of the currently logged-in user and attach it
            $data['slug'] = Str::slug($data['title']);// 4. Convert the title into a URL-friendly slug (e.g., "Test Title" becomes "test-title")

            $imagepath=$image->store('posts','public');
            $data['image'] = $imagepath;

        Post::create($data);//saving the data into the database
        return redirect()->route('dashboard'); //redirecting to homepage thi dashboard is the route name not path path is = '/' remeber ?
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // This passes the active post directly into a new view template
    return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
