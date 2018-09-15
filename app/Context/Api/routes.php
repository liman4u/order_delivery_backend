<?php
/**
 * Created by PhpStorm.
 * User: limanadamu
 * Date: 15/09/2018
 * Time: 11:27 AM
 */

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
*/

$router->group(['prefix' => 'v1'], function ($router) {

    //Orders
    $router->group([
        'prefix' => 'order',
        'namespace' => 'Order'
    ], function ($router) {
        $router->get('/', 'OrderController@index');
        $router->post('/', 'OrderController@store');
    });


});