<?php

namespace App\Policies;

use App\Models\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function view (User $user, Post $post) {
        return true;
    }

    public function edit (User $user, Post $post) {
        return ($user->id == $post->user_id) || $user->type == 'admin';
    }

    public function delete (User $user, Post $post) {
        return $user->id == $post->user_id || $user->type == 'admin';
    }

}
