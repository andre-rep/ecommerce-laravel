<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /**
         * Only gates
         * 
         */
        Gate::define('isAdmin', function(User $user){
            return $user->user_access_level == 2;
        });

        Gate::define('isUser', function(User $user){
            return $user->user_access_level == 1;
        });

        Gate::define('isLoggedIn', function(User $user){
            return $user->user_access_level != 0;
        });

        /**
         * Policies 
         * 
         */
    }
}
