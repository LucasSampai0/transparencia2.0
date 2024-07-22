<?php

namespace App\Livewire\Public;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class Supplier extends Component
{
    use WithPagination;

    public $client;
    public $categories;
    public $attachments;
    public $page = [];

    protected $updatesQueryString = ['page'];

    public function mount($slug)
    {
        $this->client = Client::where('slug', $slug)->firstOrFail();
        $this->categories = $this->client->suppliers()->with('category')->get()->pluck('category')->unique('id');
        $this->attachments = $this->client->suppliers()->with('supplierAttachments')->get()->pluck('supplierAttachments')->flatten();
    }

    public function render()
    {
        $suppliers = [];
        foreach ($this->categories as $category) {
            $suppliers[$category->id] = $this->client->suppliers()->whereHas('category', function ($query) use ($category) {
                $query->where('id', $category->id);
            })->with(['category', 'supplierAttachments'])->paginate(5, ['*'], 'page' . $category->id);
        }

        return view('livewire.public.supplier', [
            'suppliers' => $suppliers,
            'categories' => $this->categories,
            'client' => $this->client
        ])->layout('layouts.public', ['client' => $this->client]);
    }

    public function updatingPage($value, $name)
    {
        $categoryId = str_replace('page', '', $name);
        $this->page[$categoryId] = $value;
    }
}
