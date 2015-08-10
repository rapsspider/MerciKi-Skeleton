<?php

use MerciKI\Body\Router;

Router::get('/', 'NewsController@index');
Router::get('/projects', 'NewsController@index');
Router::get('/requirements/{project_id}', 'NewsController@requirements');

/**
 * Gestion des groupes
 */
Router::get( '/groupe/create',      'GroupController@create');
Router::post('/groupe/create',      'GroupController@save');
Router::get( '/groupe/{id}',        'GroupController@show');
Router::get( '/groupe/{id}/edit',   'GroupController@edit');
Router::post('/groupe/{id}/edit',   'GroupController@update');
Router::post('/groupe/{id}/delete', 'GroupController@delete');
Router::post('/groupe/{id}/compute','ComputeController@compute');


/**
 * Ajax
 */
Router::get('/types/{project_id}/list', 'TypeController@getList');

?>