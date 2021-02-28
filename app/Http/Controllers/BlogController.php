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
        $this->data['posts'] = Post::searched()->paginate(4);
        $this->data['tags'] = Tag::orderBy('name')->get();
        $this->data['categories'] = Category::orderBy('name')->get();

        return view('pages.index', $this->data);
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

    public function category(Category $category)
    {
        $this->data['category'] = $category;
        $this->data['categories'] = Category::orderBy('name')->get();
        $this->data['posts'] = $category->posts()->searched()->paginate(4);
        $this->data['tags'] = Tag::orderBy('name')->get();

        return view('pages.category.index', $this->data);
    }

    /**
     * tag
     *
     * @return void
     */
    public function tag(Tag $tag)
    {
        $this->data['tag'] = $tag;
        $this->data['tags'] = Tag::orderBy('name')->get();
        $this->data['posts'] = $tag->posts()->searched()->paginate(4);
        $this->data['categories'] = Category::orderBy('name')->get();

        $search = request()->query('q');
        if ($search) {
            $this->data['posts'] = $tag->posts()->where('title', 'LIKE', "%{$search}%")->paginate(4)->withQueryString();
        }

        return view('pages.tag.index', $this->data);
    }
}









// h: DOKUMENTASI
// paada links pagination, kita juga bisa tambahkan, jika tidak ingin pakai withQueryString() di controller
// $posts->appends(['q' => request()->query('q')])->links()
