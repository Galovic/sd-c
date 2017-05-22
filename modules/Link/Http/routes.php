<?php

Route::group(['middleware' => 'web', 'prefix' => 'module/link', 'namespace' => 'Modules\Link\Http\Controllers'], function()
{
    Route::get('create', [
        'as' => 'module.link.create',
        'uses' => 'ModuleController@create',
    ]);

    Route::post('create', [
        'uses' => 'ModuleController@store',
    ]);
});
