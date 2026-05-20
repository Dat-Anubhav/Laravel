<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
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
        $request->validate([
            'image'=>['required', 'image','mimes:jpeg,jpg,png,,gif,svg','max:2048'],
            'title'=>'required',
            'content'=>'required',
            'category_id'=>'required']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
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
