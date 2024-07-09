<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\Cast\Object_;

class AdminController extends Controller
{
    //

    public function index()
    {
        $totalBlogs = count(Blog::get());
        $totalUsers = count(User::get());

        return view('admin.dashboard',compact('totalUsers','totalBlogs'));
    }

    public function resetPassword(Request $request,User $admin){

        $this->authorize('resetPassword',$admin);

        $validated = $request->validate([
            'currentPassword' => 'required|min:8',
            'password' => 'required|confirmed|min:8'
        ]);

        if(!Hash::check($validated['currentPassword'],$admin->password)){

            $errors = (object)array('currentPassword' => ['No Matching']);

            return redirect()->back()->withErrors($errors);
        }

        $admin->password = Hash::make($validated['password']);

        $admin->update();

        return redirect()->back();
    }

    public function setAsAdmin(User $user)
    {
        $this->authorize('setAsAdmin',$user);

        $user->is_admin = true;

        $user->update();

        return redirect()->back();
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

        return redirect()->back();
    }
}
