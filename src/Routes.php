<?php

use MerciKI\Body\Router;

/** MAIN */
Router::get ('/',       'NewsController@index');
Router::get ('/admin',  'AdminController@index');
Router::get ('/logout', 'AdminController@logout');
Router::get ('/login',  'AdminController@login');
Router::post('/login',  'AdminController@loginResult');
Router::get ('/logout', 'AdminController@logout');

/** NEWS */
Router::get ('/news', 'NewsController@index');
Router::get ('/news/index', 'NewsController@index');
Router::get ('/news/index', 'NewsController@vue');
Router::get ('/news/index', 'NewsController@admin_index');
Router::get ('/admin/news/index',          'NewsController@admin_index');
Router::get ('/admin/news/add',            'NewsController@admin_add');
Router::post('/admin/news/add',            'NewsController@admin_save');
Router::get ('/admin/news/{id}/edit',      'NewsController@admin_edit');
Router::post('/admin/news/{id}/edit',      'NewsController@admin_update');
Router::post('/admin/news/{id}/delete',    'NewsController@admin_delete');

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