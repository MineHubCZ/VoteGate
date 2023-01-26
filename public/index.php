<?php

use App\Http\Middlewares\TokenAuth;
use App\Services;
use Lemon\Kernel\Application;
use Lemon\Route;
use Lemon\Templating\Juice\Syntax;

include __DIR__.'/../vendor/autoload.php';

$app = Application::init(__DIR__);

config('debug.debug', env('DEBUG_MODE') == 'true');
config('templating.juice.syntax', Syntax::blade());

$app->add(Services::class);

/**
 * Welcome landing page, usage documentation
 */

Route::template('/', 'welcome');
Route::get('/usage', fn() => template('usage', base_url: env('BASE_URL')));

/**
 * Server info endpoint
 */
Route::get('/api', function (Services $services) {
    return $services->getServerInfo();
})->middleware(TokenAuth::class);

/**
 * Player info endpoint
 */
Route::get('/api/{nick}', function ($nick, Services $services) {
    return $services->getPlayerInfo($nick);
})->middleware(TokenAuth::class);
