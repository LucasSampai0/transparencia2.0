<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;
use App\Models\Mean as MeanModel;

class Mean extends Component
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
        $this->categories = $this->client->means()->with('category')->get()->pluck('category')->unique('id');
        $this->attachments = $this->client->means()->with('meanAttachments')->get()->pluck('meanAttachments')->flatten();
    }

    public function render()
    {
        $means = [];
        foreach ($this->categories as $category) {
            $means[$category->id] = $this->client->means()->whereHas('category', function ($query) use ($category) {
                $query->where('id', $category->id);
            })->with(['category', 'meanAttachments'])->paginate(5, ['*'], 'page'.$category->id);
        }

        return view('livewire.public.mean', [
            'means' => $means,
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
