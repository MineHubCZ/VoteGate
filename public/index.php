<?php

use App\Http\Middlewares\TokenAuth;
use App\Integrations\CzechCraft;
use App\Integrations\CraftList;
use App\Integrations\MinecraftList;
use App\Integrations\MinecraftServery;
use Lemon\Kernel\Application;
use Lemon\Route;
use Lemon\Http\Request;
use Lemon\Templating\Juice\Syntax;

include __DIR__.'/../vendor/autoload.php';

Application::init(__DIR__);

config('debug.debug', env('DEBUG_MODE') == 'true');
config('templating.juice.syntax', Syntax::blade());

$services = [
    'CZECH_CRAFT' => new CzechCraft(),
    'CRAFTLIST' => new CraftList(),
    'MINECRAFT_LIST' => new MinecraftList(),
    'MINECRAFTSERVERY' => new MinecraftServery(),
];

/**
 * Welcome landing page, usage documentation
 */
Route::get('/', fn() => template('welcome'));
Route::get('/usage', fn() => template('usage', base_url: env('BASE_URL')));

/**
 * Server info endpoint
 */
Route::get('/api', function () use ($services) {
    $output = [];

    foreach ($services as $name => $service) {
        $output[$name] = $service->getServerInfo();
    }

    return $output;
})->middleware(TokenAuth::class);

/**
 * Player info endpoint
 */
Route::get('/api/{nick}', function ($nick) use ($services) {
    $output = [];

    foreach ($services as $name => $service) {
        $output[$name] = $service->getPlayerInfo($nick);
    }

    return $output;
})->middleware(TokenAuth::class);
