<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    //
    function setLocale($locale){
        $availableLocales = config('app.available_locales', []);
        $fallbackLocale = config('app.fallback_locale', config('app.locale'));
        $targetLocale = in_array($locale, $availableLocales, true) ? $locale : $fallbackLocale;

        Session::put('locale', $targetLocale);
        App::setLocale($targetLocale);
        Carbon::setLocale($targetLocale);

        return redirect()->back();
    }
}
