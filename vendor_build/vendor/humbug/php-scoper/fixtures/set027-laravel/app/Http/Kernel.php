<?php

namespace Unity3_Vendor\App\Http;

use Unity3_Vendor\Illuminate\Foundation\Http\Kernel as HttpKernel;
class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [\Unity3_Vendor\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class, \Unity3_Vendor\Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, \Unity3_Vendor\App\Http\Middleware\TrimStrings::class, \Unity3_Vendor\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, \Unity3_Vendor\App\Http\Middleware\TrustProxies::class];
    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = ['web' => [
        \Unity3_Vendor\App\Http\Middleware\EncryptCookies::class,
        \Unity3_Vendor\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Unity3_Vendor\Illuminate\Session\Middleware\StartSession::class,
        // \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Unity3_Vendor\Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \Unity3_Vendor\App\Http\Middleware\VerifyCsrfToken::class,
        \Unity3_Vendor\Illuminate\Routing\Middleware\SubstituteBindings::class,
    ], 'api' => ['throttle:60,1', 'bindings']];
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = ['auth' => \Unity3_Vendor\Illuminate\Auth\Middleware\Authenticate::class, 'auth.basic' => \Unity3_Vendor\Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, 'bindings' => \Unity3_Vendor\Illuminate\Routing\Middleware\SubstituteBindings::class, 'cache.headers' => \Unity3_Vendor\Illuminate\Http\Middleware\SetCacheHeaders::class, 'can' => \Unity3_Vendor\Illuminate\Auth\Middleware\Authorize::class, 'guest' => \Unity3_Vendor\App\Http\Middleware\RedirectIfAuthenticated::class, 'signed' => \Unity3_Vendor\Illuminate\Routing\Middleware\ValidateSignature::class, 'throttle' => \Unity3_Vendor\Illuminate\Routing\Middleware\ThrottleRequests::class];
}
