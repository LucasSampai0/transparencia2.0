<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Client;

class DesktopMenu extends Component
{

    public $client;

    public function mount($slug)
    {
        $this->client = Client::where("slug", $slug)->first();
    }

    public function render()
    {
        return view('livewire.desktop-menu');
    }
}
