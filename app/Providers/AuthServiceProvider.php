<?php

namespace App\Providers;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class
    ];


    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Gate::define('isAdmin', function($user) {
            return $user->type == 'admin';
        });

        Gate::define('isUser', function($user) {
            return $user->type == 'user';
        });

        Gate::define('userIsNotBanned', function($user) {
            if($user->isBanned()) {
                return false;
            }

            return true;
        });
    }

}
