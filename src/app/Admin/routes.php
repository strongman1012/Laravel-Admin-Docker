<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');

    $router->resource('master/users', UserController::class);
    $router->resource('master/lines', LineController::class);
    $router->resource('master/products', ProductController::class);
    $router->resource('master/line_products', LineProductController::class);

    $router->resource('dashboard/work_result', ProductVolumeController::class);
    $router->get('dashboard/chart','ProductVolumeController@chart')->name('admin.chart');

});
