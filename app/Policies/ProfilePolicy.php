<?php

namespace App\Policies;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class ProfilePolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Profile $profile)
    {
        return true;
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id || $user->role === 100;
        //return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Profile $profile)
    {
        return $user->id === $profile->user_id || $user->role === 100;
    }

    public function block(User $user, Profile $profile)
    {
        return $user->role === 100 && $profile->user->role != 100;
    }

    public function viewBlocked(User $user)
    {
        return $user->role === 100 || $user->role === 1;
    }
    public function changeRole(User $user, Profile $profile)
    {
        return $user->role === 100 && $profile->user->role != 100;
    }
}
