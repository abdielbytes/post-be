<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('index', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {

        $validated = validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Post::create($request->all());

        return redirect()->route('index')->with('success', 'Post created successfully.');
    }

    public function edit(Post $post)
    {
        return view('edit', [
            'post' => $post
        ]);
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
