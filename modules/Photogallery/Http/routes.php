<?php

Route::group(['middleware' => 'web', 'prefix' => 'module/photogallery', 'namespace' => 'Modules\Photogallery\Http\Controllers'], function()
{
    Route::get('create', [
        'as' => 'module.photogallery.create',
        'uses' => 'ModuleController@create',
    ]);

    Route::post('create', [
        'uses' => 'ModuleController@store',
    ]);
});
