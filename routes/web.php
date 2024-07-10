


<?php


use Illuminate\Support\Facades\Route;
use Filament\Http\Controllers\Auth\LogoutController;
use Livewire\Livewire;


Route::get('/', function () {
    return view('home');
});

Livewire::setUpdateRoute(function($handle){
    return Route::post('/cafeteria/public/livewire/update',$handle);
});
