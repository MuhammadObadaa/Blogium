<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;

class BlogPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user,Blog $blog){
        return $user->is_admin || $blog->ownedBy($user);
    }

    public function update(User $user,Blog $blog){
        return $user->is_admin || $blog->ownedBy($user);
    }
}
