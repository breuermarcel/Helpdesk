<?php

use C1x1\Helpdesk\Http\Controllers\AdminController;
use C1x1\Helpdesk\Http\Controllers\ChatController;

Route::group(['prefix' => 'helpdesk', 'as' => 'helpdesk.', 'namespace' => 'C1x1\Helpdesk\Http\Controllers', 'middleware' => 'web'], function () {
    // @todo check if user is admin
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [AdminController::class, 'dashboard']);
    });

    Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
        Route::get('/', [ChatController::class, 'joinChat']);
        Route::post('/load', [ChatController::class, 'getMessage'])->name('getMessage');
        Route::post('/create', [ChatController::class, 'createMessage'])->name('createMessage');
    });
});
