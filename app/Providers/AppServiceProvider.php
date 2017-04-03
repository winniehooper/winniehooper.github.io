<?php

namespace App\Providers;

use Backpack\MenuCRUD\app\Models\MenuItem;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

use Auth;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale(config('app.locale'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	    view()->composer('parts.overlays', function ($view) {
		    $uri = trim(request()->getRequestUri(), '/');
		    $show_auth = in_array($uri, ['login', 'registration', 'recovery']);

		    $success = get_message('success');
		    $error = get_message('error');

		    $view->with(compact('uri', 'show_auth', 'success', 'error'));
	    });

	    view()->composer('layouts.main', function ($view) {
		    $user = Auth::user();
            $menu = MenuItem::all();


		    $view->with(compact('user', 'menu'));
	    });

        view()->composer('*', function ($view) {
            $user = Auth::user();
            $view->with(compact('user'));
        });
    }
}
