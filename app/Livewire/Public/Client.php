<?php

namespace App\Livewire\Public;


use Livewire\Component;
use App\Models\Client as ClientModel;

class Client extends Component
{

    public $client;
    public $spendings;
    public $year;
    public $month;

    protected $listeners = ['dateChanged' => 'updateDate'];

    public function mount($slug)
    {
        $this->client = ClientModel::where('slug', $slug)->firstOrFail();
        $this->year = date('Y');
        $this->month = date('m');
        $this->spendings = collect(); // Inicializa $spendings como uma coleção vazia

    }

    public function updateDate($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
        $this->spendings = $this->getSpendingsProperty(); // Atualiza $spendings quando a data muda

    }

    public function getSpendingsProperty()
    {
        return $this->client->spendings()
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->get();
    }

    public function getTotalSpendings(){
        return $this->spendings->sum('total');
    }

    public function render()
    {
        return view('livewire.public.client', [
            'spendings' => $this->spendings,
            'totalSpendings' => $this->getTotalSpendings(),
        ])->layout('layouts.public', ['client' => $this->client]);
    }
}
