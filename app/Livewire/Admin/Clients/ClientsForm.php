<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Livewire\Component;

class ClientsForm extends Component
{

    public $client;

    public function mount()
    {
        $this->client = new Client();
    }
    public function render()
    {
        return view('livewire.admin.clients.clients-form')->layout('layouts.app', ['title' => 'Clients Form']);
    }
}
