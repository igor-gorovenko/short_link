<?php

use Inertia\Inertia;
use App\Http\Controllers\Admin\ShortLinkController;
use AshAllenDesign\ShortURL\Controllers\ShortURLController;

Route::group([
    'namespace' => 'App\Http\Controllers\Admin',
    'prefix' => config('admin.prefix'),
    'middleware' => ['auth'],
    'as' => 'admin.',
], function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('user', 'UserController');
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::resource('shortlink', 'ShortLinkController');
    Route::get('shortlink/{id}/statistics', [ShortLinkController::class, 'statistics'])->name('shortlink.statistics');
    Route::get('short/{shortURLKey}', [ShortURLController::class, '__invoke'])->name('shortlink.redirect');
    Route::resource('menu', 'MenuController')->except([
        'show',
    ]);
    Route::resource('menu.item', 'MenuItemController');
    Route::group([
        'prefix' => 'category',
        'as' => 'category.',
    ], function () {
        Route::resource('type', 'CategoryTypeController')->except([
            'show',
        ]);
        Route::resource('type.item', 'CategoryController');
    });
    Route::get('edit-account-info', 'UserController@accountInfo')->name('account.info');
    Route::post('edit-account-info', 'UserController@accountInfoStore')->name('account.info.store');
    Route::post('change-password', 'UserController@changePasswordStore')->name('account.password.store');
});
