<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return $this->show(auth()->user());
    }

    public function show(User $user)
    {
        $ideas = $user->ideas()->paginate(5);

        return view('users.show', compact('user', 'ideas'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user);

        $ideas = $user->ideas()->paginate(5);
        $editing = true;

        return view('users.show', compact('user', 'ideas', 'editing'));
    }

    public function update(Request $request,User $user)
    {
        $validated = $request->validate(['name' => 'required|min:3|max:40']);

        $user->update($validated);

        return redirect()->route('profile');
    }
}
