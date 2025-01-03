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

    // Initialize with today's date
    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
        $this->buffer_time = session('user')->buffer_time;
        $this->updateDate($this->selectedDate);
    }

    // Handle time slot selection
    public function selectTime($timeslot)
    {
        $this->selectedTimeslot = $timeslot;
        $this->dispatch('timeSelected', $this->selectedTimeslot);
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
    public function updateDate($selectedDate)
    {
        unset($this->selectedTimeslot);
        $this->selectedDate = $selectedDate;
        $day = date('l', strtotime($selectedDate));
        $this->dayAvailability = Availability::where('day', $day)->where('user_id', session('user')->id)->first();
        $this->bookedTimeslots = Booking::where('date', $selectedDate)->pluck('start_time')->toArray();
        $this->dispatch('timeSelected', $this->dayAvailability);
    }

    // Update duration
    #[On('durationChanged')]
    public function durationChange($value)
    {
        $this->duration = $value;
    }

    #[On('grabBookingData')]
    public function grabBookingData()
    {
        session('bookingDate.selectedTimeslot', $this->selectedTimeslot);
    }


    // Render view and calculate time slots
    public function render()
    {
        $this->timeslots = $this->dayAvailability ? $this->calculateTimeslots() : [];
        return view('livewire.time-selector');
    }
}
