<?php

use App\Http\Controllers\BookCallController;
use App\Livewire\DateSelector;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/counter', DateSelector::class);

Route::get('/{username}', [BookCallController::class, 'index'])
    ->where('username', '[a-zA-Z0-9_-]+')
    ->name('bookcall.index');
