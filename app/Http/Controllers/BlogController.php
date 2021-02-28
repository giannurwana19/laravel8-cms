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
        $this->data['posts'] = Post::latest()->paginate(4);
        $this->data['tags'] = Tag::orderBy('name')->get();
        $this->data['categories'] = Category::orderBy('name')->get();

        $search = request()->query('q');
        if($search){
            $this->data['posts'] = Post::where('title', 'LIKE', "%{$search}%")->paginate(4)->withQueryString();
        }

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
}









// h: DOKUMENTASI
// paada links pagination, kita juga bisa tambahkan, jika tidak ingin pakai withQueryString() di controller
// $posts->appends(['q' => request()->query('q')])->links()
