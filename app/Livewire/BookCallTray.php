<?php

namespace App\Livewire;

use Livewire\Component;


class BookCallTray extends Component
{
    public function bookCall()
    {
        // TODO: Implement bookCall() method.
        $this->dispatch('grabBookingData');
        dd(session(
            'bookingData.duration'
        ));
        // session()->forget('bookingData');
    }

    public function render()
    {
        return view('livewire.book-call-tray');
    }
}
