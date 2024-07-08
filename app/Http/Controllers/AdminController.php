<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    //

    public function resetPassword(Request $request,User $admin){

        $this->authorize('resetPassword',$admin);

        $validated = $request->validate([
            'current_password' => 'required|min:8',
            'password' => 'required|confirmed|min:8'
        ]);

        $admin->password = Hash::make($validated['password']);

        $admin->update();

        return $admin;
    }

    public function setAsAdmin(User $user)
    {
        $this->authorize('setAsAdmin',$user);

        $user->is_admin = true;

        $user->update();

        return $user;
    }

    public function setOwners(Request $request,Blog $blog){



        $request->validate([
            'users' => 'required|array',
            'users.*' => [
                'required',
                Rule::exists('users','id')
            ]
        ]);

        $users = User::whereIn('id',$request['users'])->get();

        foreach($users as $user) {
            if(!$blog->ownedBy($user)){
                $user->blogs()->attach($blog);
            }
        }

        $blog->refresh();

        return $blog;
    }
}
