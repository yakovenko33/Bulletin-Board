<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api')
    //->middleware(['filter.input.data'])
    ->namespace("BulletinBoard\UserModule\UI\Controllers")
    ->group(function () {
        Route::get('/user/test', 'UserController@test'); //get
        Route::post('/user/sing-up', 'UserController@singUp'); //get
        #Route::post('/user/login', 'UserController@login');
        #Route::post('/user/messages', 'MessageController@addMessage');
        #Route::get('/user/all/messages', 'MessageController@getAllUserMessages');
    });
