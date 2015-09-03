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
Router::get ('/news',       'NewsController@index');
Router::get ('/news/index', 'NewsController@index');
Router::get ('/news/{id}',  'NewsController@vue');
Router::get ('/admin/news/index',          'NewsController@admin_index');
Router::get ('/admin/news/add',            'NewsController@admin_add');
Router::post('/admin/news/add',            'NewsController@admin_save');
Router::get ('/admin/news/{id}/edit',      'NewsController@admin_edit');
Router::post('/admin/news/{id}/edit',      'NewsController@admin_update');
Router::get('/admin/news/{id}/delete',    'NewsController@admin_delete');

/** IMAGES */
Router::get ('/images',           'ImagesController@index');
Router::get ('/images/index',     'ImagesController@index');
Router::get ('/images/liste.json', 'ImagesController@getListe');
Router::get ('/images/liste.xml',  'ImagesController@getListexml');
Router::get ('/admin/images/index',          'ImagesController@admin_index');
Router::get ('/admin/images/add',            'ImagesController@admin_add');
Router::post('/admin/images/add',            'ImagesController@admin_save');
Router::get ('/admin/images/{id}/edit',      'ImagesController@admin_edit');
Router::post('/admin/images/{id}/edit',      'ImagesController@admin_update');
Router::post('/admin/images/{id}/delete',    'ImagesController@admin_delete');


?>