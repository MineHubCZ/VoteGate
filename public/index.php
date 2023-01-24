<?php

use App\Http\Middlewares\TokenAuth;
use Lemon\Kernel\Application;
use Lemon\Route;
use App\Integrations\CzechCraft;
use App\Integrations\CraftList;
use App\Integrations\MinecraftList;
use App\Integrations\MinecraftServery;

include __DIR__.'/../vendor/autoload.php';

Application::init(__DIR__);

$services = [
    'CZECH_CRAFT' => new CzechCraft(),
    'CRAFTLIST' => new CraftList(),
    'MINECRAFT_LIST' => new MinecraftList(),
    'MINECRAFTSERVERY' => new MinecraftServery(),
];

/**
 * Welcome landing page
 */
Route::get('/', fn() => template('welcome'));

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
