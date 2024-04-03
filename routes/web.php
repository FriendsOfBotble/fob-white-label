<?php

use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::namespace('FriendsOfBotble\WhiteLabel\Http\Controllers')->group(function () {
    AdminHelper::registerRoutes(function () {
        Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
            Route::get('white-label', [
                'as' => 'white-label.settings',
                'uses' => 'WhiteLabelSettingController@edit',
            ]);

            Route::put('white-label', [
                'as' => 'white-label.settings.update',
                'uses' => 'WhiteLabelSettingController@update',
                'permission' => 'white-label.settings',
            ]);
        });
    });
});
