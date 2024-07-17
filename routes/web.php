<?php

use App\Livewire\Admin\Clients\ClientsForm;
use App\Livewire\Admin\Clients\ClientsList;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

});
    Route::get('{slug}', App\Livewire\Public\Client::class)->name('client.public');
