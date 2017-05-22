<?php

Route::group(['middleware' => 'web', 'prefix' => 'module/text', 'namespace' => 'Modules\Text\Http\Controllers'], function()
{
    Route::get('create', [
        'as' => 'module.text.create',
        'uses' => 'ModuleController@create',
    ]);

    Route::post('create', [
        'uses' => 'ModuleController@store',
    ]);
});
