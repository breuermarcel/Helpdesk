<?php


Route::group(['namespace' => 'C1x1\Helpdesk\Http\Controllers'], function() {
    Route::view('contact', 'helpdesk::home')->name('contact');
});
