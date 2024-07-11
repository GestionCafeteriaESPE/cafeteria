<?php


use Illuminate\Support\Facades\Route;
use Filament\Http\Controllers\Auth\LogoutController;
use Livewire\Livewire;
use App\Livewire\Counter;
 
Route::get('/counter', Counter::class);

Route::get('/', function () {
    return view('home');
});

Livewire::setUpdateRoute(function($handle){
    return Route::post('/cafeteria/public/livewire/update',$handle);
});
