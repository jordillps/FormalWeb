<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
        view()->composer(['partials.language_switcher', 'admin.partials.navbar'], function ($view) {
            $current_locale = app()->getLocale();
            $view->with('current_locale', $current_locale);
            $view->with('current_locale_name', trans('global.' . $current_locale));
            $view->with('available_locales', config('app.available_locales'));
        });

    }
}
