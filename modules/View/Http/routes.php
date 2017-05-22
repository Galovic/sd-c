<?php

Route::group(['middleware' => 'web', 'prefix' => 'module/view', 'namespace' => 'Modules\View\Http\Controllers'], function()
{
    Route::get('create', [
        'as' => 'module.view.create',
        'uses' => 'ModuleController@create',
    ]);

    Route::post('create', [
        'uses' => 'ModuleController@store',
    ]);
});
