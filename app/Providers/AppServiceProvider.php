<?php

namespace App\Providers;

use App\Mail\MailSend;
use App\Mail\MailContract;
use App\Products\Product;
use App\Products\ProductContract;
use App\Users\User;
use App\Users\UserContract;
use App\Purchase\PurchaseContract;
use App\Purchase\Purchase;
use App\Pages\PublicAccessPage;
use App\Pages\UserAccessPage;
use App\Pages\AdminAccessPage;
use App\Pages\AccessPageContract;
use App\Directories\PublicDirectory;
use App\Files\StorageLocalFileManagement;
use App\Files\StoragePublicDirectory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Service Provider for Emails
        $this->app->singleton(MailContract::class, function($app){
            return new MailSend();
        });

        //Service Provider for Purchase
        $this->app->singleton(PurchaseContract::class, function($app){
            return new Purchase();
        });

        //Service Provider for Pages
        $this->app->singleton(AccessPageContract::class, function($app){
            if(Auth::user() != null){
                //Show User page if user's level is 1
                if(Auth::user()->user_access_level == 1){
                    return new UserAccessPage();
                }
                //Show Admin page if user's level is 2
                if(Auth::user()->user_access_level == 2){
                    return new AdminAccessPage(request());
                }
            }else{
                //Show Public page if user is not logged in
                return new PublicAccessPage();
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
