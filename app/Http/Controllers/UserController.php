<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
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

    /**
     * makeAdmin
     *
     * @param  mixed $user
     * @return void
     */
    public function makeAdmin(User $user)
    {
        $user->role = 'admin';

        $user->save();

        return redirect()->route('users.index')->with('success', 'This users role is admin now!');
    }

    /**
     * edit
     *
     * @return void
     */
    public function edit()
    {
        $user = auth()->user();

        return view('users.edit', compact('user'));
    }

    /**
     * update
     *
     * @return void
     */
    public function update(UserRequest $request)
    {
        $user = auth()->user();

        $user->update($request->validated());

        return redirect()->back()->with('success', 'User updated successfully!');
    }
}
