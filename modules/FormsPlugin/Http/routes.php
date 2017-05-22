<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin/forms', 'namespace' => 'Modules\FormsPlugin\Http\Controllers\Admin'], function()
{
    Route::get('/', [
        'as' => 'admin.module.forms_plugin',
        'uses' => 'FormsController@index'
    ]);
    Route::post('/', [
        'as' => 'admin.module.forms_plugin.store',
        'uses' => 'FormsController@store',
    ]);

    Route::get('create', [
        'as' => 'admin.module.forms_plugin.create',
        'uses' => 'FormsController@create',
    ]);

    Route::get('{form}/edit', [
        'as' => 'admin.module.forms_plugin.edit',
        'uses' => 'FormsController@edit',
    ]);

    Route::patch('{form}', [
        'as' => 'admin.module.forms_plugin.update',
        'uses' => 'FormsController@update',
    ]);

    Route::get('{form}/responses', [
        'as' => 'admin.module.forms_plugin.responses',
        'uses' => 'FormsController@responses',
    ]);

    Route::get('{response}/download-file/{field}', [
        'as' => 'admin.module.forms_plugin.download-file',
        'uses' => 'FormsController@downloadFile',
    ]);

    Route::delete('{form}/delete', [
        'as' => 'admin.module.forms_plugin.delete',
        'uses' => 'FormsController@delete',
    ]);
});

Route::group(['middleware' => 'web', 'prefix' => 'forms', 'namespace' => 'Modules\FormsPlugin\Http\Controllers'], function()
{
    Route::get('create', [
        'as' => 'module.formsplugin.create',
        'uses' => 'ModuleController@create',
    ]);

    Route::post('create', [
        'uses' => 'ModuleController@store',
    ]);

    Route::post('{form}/submit', [
        'as' => 'module.formsplugin.submit',
        'uses' => 'FormController@formSubmit',
    ]);
});
