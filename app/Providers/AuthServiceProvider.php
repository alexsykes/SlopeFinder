<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Policies\NotePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        Gate::define('manage_users', function(User $user) {
            return $user->role == "admin";
        });
//        $this->registerPolicies();



        /* define a admin user role */

        Gate::define('isAdmin', function($user) {

            return $user->role == 'admin';

        });



        /* define a manager user role */

        Gate::define('isEditor', function($user) {

            return $user->role == 'editor';

        });



        /* define a user role */

        Gate::define('isUser', function($user) {

            return $user->role == 'user';

        });
    }
}
