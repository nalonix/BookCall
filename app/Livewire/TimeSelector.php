<?php

namespace App\Livewire;

use App\Models\Availability;
use App\Models\Booking;
use Livewire\Attributes\On;
use Livewire\Component;

class TimeSelector extends Component
{
    public $selectedDate; // Currently selected date
    public $selectedTimeslot; // Selected time slot
    public $dayAvailability; // Availability for the selected day
    public $duration = 30; // Time slot duration in minutes
    public $buffer_time = 15; // Gap between slots in minutes
    public $bookedTimeslots = []; // Booked slots for the selected date
    public $timeslots = []; // Generated available time slots

    public function mount()
    {
        // Calculate the next available date
        $this->selectedDate = $this->getNextAvailableDate();
        // Initialize buffer time
        $this->buffer_time = session('user')->buffer_time;
        // Update the date and fetch availability
        $this->updateDate($this->selectedDate);
    }

    // Method to calculate the next available date
    private function getNextAvailableDate()
    {
        $availableDays = session('availableDays')->toArray();
        $date = now()->addDay();

        while (!in_array($date->format('l'), $availableDays)) {
            $date->addDay();
        }

        return $date->format('Y-m-d');
    }

    // Handle time slot selection
    public function selectTime($timeslot)
    {
        $this->selectedTimeslot = $timeslot;
        $this->dispatch('inputChange', 'time', $this->selectedTimeslot);
    }

    // Generate available time slots
    private function calculateTimeslots()
    {
        $timeslots = [];
        $accum = date('H:i:s', strtotime($this->dayAvailability->start_time));

        while ($accum <= date('H:i:s', strtotime($this->dayAvailability->end_time))) {
            $startTime = $accum;
            $accum = date('H:i:s', strtotime($accum) + ($this->duration * 60));
            $endTime = $accum;
            $accum = date('H:i:s', strtotime($accum) + ($this->buffer_time * 60));

            if (!in_array($startTime, $this->bookedTimeslots)) {
                $timeslots[] = $startTime . ' - ' . $endTime;
            }
        }

        return $timeslots;
    }

    // Update date and fetch availability and bookings
    #[On('dateSelected')]
    public function updateDate($date)
    {
        $this->selectedDate = $date;
        $day = date('l', strtotime($date));
        $this->dayAvailability = Availability::where('day', $day)->where('user_id', session('user')->id)->first();
        $this->bookedTimeslots = Booking::where('date', $date)->where('user_id', session('user')->id)->pluck('start_time')->toArray();
    }

    // Update duration
    #[On('durationChanged')]
    public function durationChange($value)
    {
        $this->duration = $value;
    }

    // Render view and calculate time slots
    public function render()
    {
        $this->timeslots = $this->dayAvailability ? $this->calculateTimeslots() : [];
        return view('livewire.time-selector');
    }
}
