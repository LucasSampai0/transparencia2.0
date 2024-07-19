<?php

namespace App\Livewire\Public;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class PublicSession extends Component
{
    use WithPagination;

    public $client;

    public function mount($slug)
    {
        $this->client = Client::where('slug', $slug)->firstOrFail();
    }

    public function limitString($string, $limit = 50)
    {
        return strlen($string) > $limit ? substr($string, 0, $limit) . "..." : $string;
    }

    public function render()
    {
        $publicSessions = $this->client->publicSessions()->paginate(5);
        return view('livewire.public.public-session', ['publicSessions' => $publicSessions])->layout('layouts.public', ['client' => $this->client]);
    }
}
