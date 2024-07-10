<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class ClientsList extends Component
{

    public $clients;
    public $pageTitle;

    public function mount()
    {
        $this->clients = Client::all();
    }

    public function render()
    {
        $this->pageTitle  = 'Clients List';
        return view('livewire.admin.clients.clients-list')->layout('layouts.app', ['title' => 'Clients List']);
    }
}
