<?php

$router->group(['prefix' => 'v1'], function($router) {
    $router->group(['prefix' => 'transaction'], function($router) {
        $router->post('/', 'TransactionController@peerToPeer');
    });
});