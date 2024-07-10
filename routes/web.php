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
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('admin/clients', ClientsList::class)->name('admin.clients.index');
    Route::get('admin/clients/create', ClientsForm::class)->name('admin.clients.create');
    Route::get('admin/clients/update/{slug}', ClientsForm::class)->name('admin.clients.update');

});
