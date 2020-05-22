<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')
    //->middleware(['filter.input.data'])
    ->namespace("BulletinBoard\UserModule\UI\Controllers")
    ->group(function () {
        Route::get('/user/test-post', 'UserController@testPost'); //get
        Route::get('/user/test', 'UserController@test'); //get
        Route::post('/user/sing-up', 'UserController@singUp');
        Route::post('/user/sing-in', 'UserController@singIn');
    });
