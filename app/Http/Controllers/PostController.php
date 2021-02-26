<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategoryCount')->only('create', 'store');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $image = $request->hasFile('image') ? $request->file('image')->store('images') : null;

        $data = $request->validated();
        $data['image'] = $image;

        $post = Post::create($data);

        $post->tags()->sync($data['tags']);

        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();
        $data['image'] = $post->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('images');

            $post->deleteImage();

            $data['image'] = $image;
        } else {
            $data['image'] = $post->image;
        }

        $post->update($data);

        $post->tags()->sync($data['tags']);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
            $post->tags()->detach();

            return redirect()->route('posts.trashed')->with('success', 'Post deleted permanent successfully!');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    /**
     * Display a listing of the trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $posts = Post::onlyTrashed()->latest()->get();

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Restore the resource which is deleted.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Post::withTrashed()->where('id', $id)->firstOrFail()->restore();

        return redirect()->route('posts.index')->with('success', 'Post restored successfully!');
    }
}
