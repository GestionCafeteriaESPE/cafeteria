<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Filament\Http\Controllers\Auth\LogoutController;
use Livewire\Livewire;
use App\Livewire\Counter;
use Illuminate\Http\Request;

Route::get('/counter', Counter::class);

Route::get('/', function (Request $request) {
    return app(HomeController::class)($request);
});

Livewire::setUpdateRoute(function($handle){
    return Route::post('/cafeteria/public/livewire/update',$handle);
});

