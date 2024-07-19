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
    Route::get('{slug}/veiculos', App\Livewire\Public\Mean::class)->name('client.mean');
    Route::get('{slug}/fornecedores', App\Livewire\Public\Supplier::class)->name('client.supplier');
    Route::get('{slug}/sessoes-publicas', App\Livewire\Public\PublicSession::class)->name('client.public-session');
