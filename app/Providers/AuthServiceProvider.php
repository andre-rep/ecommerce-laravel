<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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
        Gate::define('isAdmin', function(){
            if(Auth::check()){
                return Auth::user()->hasRole('admin');
            }
        });

        Gate::define('isUser', function(){
            if(Auth::check()){
                return Auth::user()->hasRole('user');
            }
        });

        /**
         * Policies 
         * 
         */
    }
}
