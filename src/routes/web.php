<?php

use C1x1\Helpdesk\Http\Controllers\AdminController;
use C1x1\Helpdesk\Http\Controllers\AuthController;
use C1x1\Helpdesk\Http\Controllers\ChatController;

Route::group(['prefix' => 'helpdesk', 'as' => 'helpdesk.', 'namespace' => 'C1x1\Helpdesk\Http\Controllers', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/chat/{chatID}', [AdminController::class, 'joinChat'])->name('joinChat');
    });

    Route::get('register', [AuthController::class, 'registerForm'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('doRegister');

    Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
        Route::get('/', [ChatController::class, 'joinChat'])->name('joinChat');
        Route::post('/load', [ChatController::class, 'getMessage'])->name('getMessage');
        Route::post('/create', [ChatController::class, 'createMessage'])->name('createMessage');
        Route::get('/archive/{chatID}', [ChatController::class, 'archiveChat'])->name('archiveChat');
        Route::get('/reset/{chatID}', [ChatController::class, 'resetChat'])->name('resetChat');
    });
});
