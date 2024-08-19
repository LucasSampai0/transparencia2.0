<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Client as ClientModel;
use Livewire\WithPagination;

class Spending extends Component
{
    use WithPagination;

    public $clientId;
    protected $client;
    public $year;
    public $month;

    protected $listeners = ['dateChanged' => 'updateDate'];

    public function mount($slug)
    {
        $this->client = ClientModel::where('slug', $slug)->firstOrFail();
        $this->clientId = $this->client->id;
        $this->year = date('Y');
        $this->month = date('m');
    }

    public function updateDate($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

    public function getSpendingSuppliersProperty()
    {
        return $this->client->spendings()
            ->with('supplier')
            ->where('type', 'spending_supplier')
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->paginate(5, ['*'], 'pageSupplier');
    }

    public function getSpendingMeansProperty()
    {
        return $this->client->spendings()
            ->with('mean')
            ->where('type', 'spending_mean')
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->paginate(5, ['*'], 'pageMean');
    }

    public function render()
    {
        return view('livewire.public.spending', [
            'client' => $this->client,
            'spendingSuppliers' => $this->spendingSuppliers,
            'spendingMeans' => $this->spendingMeans,
            'year' => $this->year,
            'month' => $this->month,
        ])->layout('layouts.public', ['client' => $this->client]);
    }

    public function hydrate()
    {
        $this->client = ClientModel::find($this->clientId);
    }
}
