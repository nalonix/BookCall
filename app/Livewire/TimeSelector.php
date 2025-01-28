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
        // // Initialize buffer time
        $this->buffer_time = session('buffer_time');
        // Update the date and fetch availability
        $this->updateDate($this->selectedDate);
    }

    // Method to calculate the next available date
    private function getNextAvailableDate()
    {
        $availableDays = session('availableDays')->toArray();
        $date = now()->addDay();
        $stopper = 0;

        while (!in_array($date->format('l'), $availableDays) && $stopper < 10) {
            $date->addDay();
            $stopper++;
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

        // Ensure dayAvailability is set and has valid start and end times
        if (!$this->dayAvailability || !isset($this->dayAvailability['start_time'], $this->dayAvailability['end_time'])) {
            return $timeslots; // Return empty if no availability
        }

        $startTime = strtotime($this->dayAvailability['start_time']);
        $endTime = strtotime($this->dayAvailability['end_time']);

        // Ensure duration and buffer time are valid positive numbers
        if ($this->duration <= 0 || $this->buffer_time < 0) {
            return $timeslots; // Return empty if invalid duration or buffer time
        }

        $accum = $startTime;

        while ($accum + ($this->duration * 60) <= $endTime) {
            $slotStart = date('H:i:s', $accum);
            $slotEnd = date('H:i:s', $accum + ($this->duration * 60));

            // Ensure time slot does not exceed end_time
            if (strtotime($slotEnd) > $endTime) {
                break;
            }

            // Only add if not booked
            if (!in_array($slotStart, $this->bookedTimeslots)) {
                $timeslots[] = "$slotStart - $slotEnd";
            }

            // Move to the next slot, considering buffer time
            $accum += ($this->duration * 60) + ($this->buffer_time * 60);
        }

        return $timeslots;
    }


    // Update date and fetch availability and bookings
    #[On('dateSelected')]
    public function updateDate($date)
    {
        $this->selectedDate = $date;
        $day = date('l', strtotime($date));
        $dailyTimeRanges = session('dailyTimeRange');
        $this->dayAvailability = $dailyTimeRanges[$day] ?? null;
        $this->bookedTimeslots = Booking::where('date', $date)->where('user_id', session('user_id'))->pluck('start_time')->toArray();
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
