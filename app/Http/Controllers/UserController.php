<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';

        $user->save();

        return redirect()->route('users.index')->with('success', 'This users role is admin now!');
    }
}
