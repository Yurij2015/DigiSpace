<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const string HOME = '/admin';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', static function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        // Every endpoint below gets its own named limiter. The bare `throttle:max,decay` form keys
        // only on domain+IP, so all of them shared one counter and spending the newsletter
        // allowance used to lock a visitor out of password reset on their first attempt.

        // The two site forms carry content a visitor typed, so a bare 429 page would throw it
        // away. They redirect back with the input intact and a localized message instead.
        RateLimiter::for('contact-form', static function (Request $request) {
            return self::perVisitor($request, 10)->response(
                static fn (Request $request, array $headers) => back()
                    ->withInput()
                    ->withErrors(['throttle' => self::throttleMessage($headers)])
            );
        });

        RateLimiter::for('subscribe', static function (Request $request) {
            return self::perVisitor($request, 10)->response(
                // The footer form reads its errors from the `subscribe` bag, keyed on `email`.
                static fn (Request $request, array $headers) => back()
                    ->withInput()
                    ->withErrors(['email' => self::throttleMessage($headers)], 'subscribe')
            );
        });

        // Password reset keeps the plain 429: nothing typed is lost on retry. Asking for a link
        // and submitting the new password are counted apart on purpose, so over-requesting a link
        // cannot lock someone out of finishing the reset they just started.
        RateLimiter::for('password-request', static fn (Request $request) => self::perVisitor($request, 6));
        RateLimiter::for('password-reset', static fn (Request $request) => self::perVisitor($request, 6));
    }

    private static function perVisitor(Request $request, int $perMinute): Limit
    {
        return Limit::perMinute($perMinute)->by($request->user()?->id ?: $request->ip());
    }

    /**
     * @param  array<string, mixed>  $headers  as built by ThrottleRequests::buildException()
     */
    private static function throttleMessage(array $headers): string
    {
        return __('site.too_many_requests', ['seconds' => $headers['Retry-After'] ?? 60]);
    }
}
