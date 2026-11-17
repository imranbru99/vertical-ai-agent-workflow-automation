<?php

use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;

Route::controller(MarketingController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/features', 'features')->name('features');
    Route::get('/modules', 'modules')->name('modules');
    Route::get('/workflows', 'workflows')->name('workflows');
    Route::get('/agents', 'agents')->name('agents');
    Route::get('/pricing', 'pricing')->name('pricing');
    Route::get('/demo', 'demo')->name('demo');
});
