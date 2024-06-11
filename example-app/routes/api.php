<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group( function() {
    
    Route::resource('hello', 'Api\V1\HelloController');

    //usuarios
    Route::resource('usuarios','Api\V1\UserController');

    Route::resource('meso-ciclos', 'Api\V1\MesoCicloController');
    Route::post('meso-ciclos', 'Api\V1\MesoCicloController@store');


});