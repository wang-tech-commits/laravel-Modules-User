<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Admin',
], function (Router $router) {
    $router->resource('users', 'IndexController');
});
