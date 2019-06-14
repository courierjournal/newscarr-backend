<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Contacts
$router->group(['prefix' => 'contacts'], function () use ($router) {
    $router->get('get-list', 'ContactsController@getList');
    $router->post('upsert-record', 'ContactsController@upsertRecord');
    $router->delete('delete-record', 'ContactsController@deleteRecord');
});

//Bookmarks
$router->group(['prefix' => 'bookmarks'], function () use ($router) {
    $router->get('get-list', 'BookmarksController@getList');
    $router->post('upsert-record', 'BookmarksController@upsertRecord');
    $router->delete('delete-record', 'BookmarksController@deleteRecord');
});

//Gun Violence Tracker
$router->group(['prefix' => 'gun-violence-database'], function () use ($router) {
    $router->get('get-list', 'GunViolenceController@getList');
    $router->get('get-full-record/{id}', 'GunViolenceController@getFullRecord');
    $router->post('upsert-record', 'GunViolenceController@upsertRecord');
    $router->delete('delete-record', 'GunViolenceController@deleteRecord');
});
