<?php

$router->group(['prefix' => 'transaction'], function($router) {
    $router->post('/', 'TransactionController@peerToPeer');
});
