<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function update(User $admin,User $user) {
        return $admin->is_admin;
    }

    public function destroy(User $admin,User $user) {
        return $admin->is_admin;
    }

    public function setAsAdmin(User $admin,User $user) {
        return $admin->is_admin;
    }

    public function resetPassword(User $admin,User $user){
        return $admin->is_admin && $user->is_admin;
    }

}
