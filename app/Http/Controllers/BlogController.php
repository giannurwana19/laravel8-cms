<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $posts = Post::latest()->paginate(4);
        $tags = Tag::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        return view('pages.index', compact('posts', 'tags', 'categories'));
    }

    /**
     * show
     *
     * @return void
     */
    public function show(Post $post)
    {
        return view('pages.show', compact('post'));
    }
}
