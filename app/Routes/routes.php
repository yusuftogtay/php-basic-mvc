<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use App\Middlewares\AuthMiddleware;
use Core\Router\Route;

/** @var array routes */
$routes = [
    new Route('/public/user/', new UserController(), 'index', [AuthMiddleware::class]),
    new Route('/public/user/{id}', new UserController(), 'show', [], ['id']),
    new Route('/public/create', new UserController(), 'create', [], []),
    new Route('/public/blog/{id}/translations/{language_id}', new HomeController(), 'blogs', [], ['id', 'language_id']),
    new Route('/public/', new HomeController(), 'index'),
];

return $routes;
