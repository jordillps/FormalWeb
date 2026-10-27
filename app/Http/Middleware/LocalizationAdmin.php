<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationAdmin
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle(Request $request, Closure $next)
    {
        $availableLocales = config('app.available_locales', []);
        $fallbackLocale = config('app.fallback_locale', config('app.locale'));
        $sessionLocale = Session::get('locale');
        $routeLocale = $request->segment(1);

        if (is_string($routeLocale) && in_array($routeLocale, $availableLocales, true)) {
            $targetLocale = $routeLocale;
        } elseif (is_string($sessionLocale) && in_array($sessionLocale, $availableLocales, true)) {
            $targetLocale = $sessionLocale;
        } else {
            $targetLocale = $fallbackLocale;
        }

        App::setLocale($targetLocale);
        Session::put('locale', $targetLocale);
        Carbon::setLocale($targetLocale);

        return $next($request);
    }
}
