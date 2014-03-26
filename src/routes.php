<?php

// TODO get endpoint from config

Route::get(Config::get('loginchecka::urls.login'), 'Zwacky\Loginchecka\Controllers\LoginController@getLogin');
Route::post(Config::get('loginchecka::urls.login'), 'Zwacky\Loginchecka\Controllers\LoginController@postLogin');
Route::get(Config::get('loginchecka::urls.login') . '/logout', 'Zwacky\Loginchecka\Controllers\LoginController@getLogout');
