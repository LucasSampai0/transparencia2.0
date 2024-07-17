<?php

namespace App\Livewire\Public;


use Livewire\Component;
use App\Models\Client as ClientModel;

class Client extends Component
{

    public $client;

    public function mount($slug)
    {
        $this->client = ClientModel::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.public.client')->layout('layouts.public', ['client' => $this->client]);
    }
}
