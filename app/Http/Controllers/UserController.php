<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id','ASC');

        return view('admin.users.index',['users' => $users->paginate(5)]);
    }

    public function show(User $user)
    {
        $blogs = $user->blogs()->paginate(5);

        return view('users.show', compact('user', 'blogs'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user);

        $blogs = $user->blogs()->paginate(5);

        $editing = true;

        return view('users.show', compact('user', 'editing','blogs'));
    }

    public function update(Request $request,User $user)
    {
        $validated = $request->validate(['name' => 'required|min:3|max:40']);

        $user->update($validated);

        return redirect()->route('admin.users.show',$user);
    }
}
