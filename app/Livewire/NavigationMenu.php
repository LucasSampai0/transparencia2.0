<?php

namespace App\Livewire;

use Livewire\Component;

class NavigationMenu extends Component
{

    public function ClientList()
    {
        return $this->redirect(route('clients.list'));
    }

    public function render()
    {
        return view('navigation-menu');
    }
}
