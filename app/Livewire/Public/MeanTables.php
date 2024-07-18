<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Mean as MeanModel;
use Livewire\WithPagination;

class MeanTables extends Component
{
    use WithPagination;

    public $client;
    public $means;
    public $categories;
    public $attachments;

    public function mount()
    {


    }

    public function render()
    {
        $this->means = $this->client->means()->with(['category', 'meanAttachments'])->get();
        $this->categories = $this->means->pluck('category')->unique('id');
        $this->attachments = $this->means->pluck('meanAttachments')->flatten();
        $means = MeanModel::paginate(5);

        return view('livewire.public.mean-tables',
            ['users' => $means]
        );
    }
}
