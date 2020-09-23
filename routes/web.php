<?php
$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'transaction'], function($router) {
    $router->post('/', 'TransactionController@peerToPeer');
});
