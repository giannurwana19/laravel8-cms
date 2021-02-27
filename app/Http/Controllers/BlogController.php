<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        return view('pages.index');
    }

    /**
     * show
     *
     * @return void
     */
    public function show($id)
    {
        return view('pages.show');
    }
}
