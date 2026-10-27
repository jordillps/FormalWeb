<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class LocaleSwitchingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('web')->get('/test-locale-no-prefix', function () {
            return response()->json([
                'app_locale' => app()->getLocale(),
                'session_locale' => session('locale'),
            ]);
        });

        Route::middleware('web')->get('/{locale}/test-locale-switch', function () {
            return response()->json([
                'app_locale' => app()->getLocale(),
                'session_locale' => session('locale'),
            ]);
        })->where('locale', '[a-zA-Z]{2}');
    }

    public function test_route_locale_has_priority_over_session_locale(): void
    {
        $this->withSession(['locale' => 'ca'])
            ->get('/es/test-locale-switch')
            ->assertOk()
            ->assertJson([
                'app_locale' => 'es',
                'session_locale' => 'es',
            ]);
    }

    public function test_invalid_route_locale_falls_back_to_session_locale(): void
    {
        $this->withSession(['locale' => 'en'])
            ->get('/xx/test-locale-switch')
            ->assertOk()
            ->assertJson([
                'app_locale' => 'en',
                'session_locale' => 'en',
            ]);
    }

    public function test_fallback_locale_is_used_when_no_valid_locale_is_present(): void
    {
        $this->get('/test-locale-no-prefix')
            ->assertOk()
            ->assertJson([
                'app_locale' => config('app.fallback_locale'),
                'session_locale' => config('app.fallback_locale'),
            ]);
    }
}
