<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Gun Violence Tracker
$router->group(['prefix' => 'gun-violence-database'], function () use ($router) {
    $router->get('get-list', 'GunViolenceController@getList');
    $router->get('get-full-record/{id}', 'GunViolenceController@getFullRecord');
    $router->post('upsert-incident', 'GunViolenceController@upsertIncident');
    $router->post('upsert-suspect', 'GunViolenceController@upsertSuspect');
    $router->post('upsert-victim', 'GunViolenceController@upsertVictim');
    $router->delete('delete-record', 'GunViolenceController@deleteRecord');
});
