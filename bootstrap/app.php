<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\LocaleMiddleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    // Add your middleware aliases here
    $middleware->redirectGuestsTo('/');
    $middleware->alias([
      'redirect' => \App\Http\Middleware\RedirectIfNotApplicant::class,
      'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
      'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
      'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
      '2fa' => \App\Http\Middleware\Email2faMiddleware::class,
      'userverified' => \App\Http\Middleware\CustomerEmailIsVerified::class,
      'capture_user_agent' => \App\Http\Middleware\CaptureUserAgentData::class,
    ]);


    $middleware->use([
      \App\Http\Middleware\BannedIpMiddleware::class
    ]);


    $middleware->web(append: [
      \App\Http\Middleware\AccessLogMiddleware::class,
      \App\Http\Middleware\LocaleMiddleware::class,

    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
