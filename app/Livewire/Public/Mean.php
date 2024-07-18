<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Client;

class Mean extends Component
{
    public $client;
    public $categories;

    public function mount($slug)
    {
        $this->client = Client::where('slug', $slug)->first();
        $this->categories = $this->client->means()->with('category')->get()->pluck('category')->unique('id');

    }

    public function render()
    {
        return view('livewire.public.mean', ['categories' => $this->categories])->layout('layouts.public');
    }
}
