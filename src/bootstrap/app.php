<?php

use App\Exceptions\BusinessLogicException;
use App\Http\Middleware\JsonAccept;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->use([
            JsonAccept::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
/*
|--------------------------------------------------------------------------
| Custom app directory
|--------------------------------------------------------------------------
*/
$app->useAppPath(realpath(__DIR__.'/../app/App'));

return $app;
