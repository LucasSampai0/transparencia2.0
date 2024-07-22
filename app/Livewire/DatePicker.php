<?php

namespace App\Livewire;

use Livewire\Component;

class DatePicker extends Component
{

    public $Year;
    public $Month;

    public function mount()
    {
        $this->Year = date('Y');
        $this->Month = date('m');
    }

    public function decrementYear()
    {
        $this->Year--;
        $this->emitDateChange();
    }

    public function incrementYear()
    {
        $this->Year++;
        $this->emitDateChange();
    }

    public function updateMonth($month)
    {
        $this->Month = $month;
        $this->emitDateChange();
    }

    public function emitDateChange()
    {
        $this->dispatch('dateChanged', $this->Year, $this->Month);
    }

    public function render()
    {
        return view('livewire.date-picker', [
            'Year' => $this->Year,
            'Month' => $this->Month,
        ]);
    }
}
