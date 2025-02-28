<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Attributes\On;
use Livewire\Component;


class BookCallTray extends Component
{
    public $formData = [
        'name' => '',
        'email' => '',
        'title' => '',
        'description' => '',
        'duration' => 60,
        'date' => '',
        'time' => '',
    ];

    public function bookCall()
    {
        // Split the time into start and end times
        [$startTime, $endTime] = explode(' - ', $this->formData['time']);

        // Insert the form data into the database
        Booking::create([
            'user_id' => session('user_id'),
            'client_name' => $this->formData['name'],
            'client_email' => $this->formData['email'],
            'title' => $this->formData['title'],
            'description' => $this->formData['description'],
            'meeting_link' => '',
            'duration' => $this->formData['duration'],
            'date' => $this->formData['date'],
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return redirect('/booked')->with('message', 'booking complete')->with('bookingData', $this->formData);
    }

    #[On('inputChange')]
    public function inputChange($propertyName, $value)
    {
        $this->formData[$propertyName] = $value;
    }

    public function render()
    {
        return view('livewire.book-call-tray');
    }
}
