<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class TimeSelector extends Component
{
    public $selectedDate;

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    #[On('dateSelected')]
    public function updateDate($selectedDate)
    {
        $this->selectedDate = $selectedDate;
    }
    public function render()
    {
        return view('livewire.time-selector');
    }
}
