<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class DateSelector extends Component
{
    public $selectedDate;
    public $viewMonthYear;
    public $calendarGrid;

    public function mount()
    {
        $availableDays = session('availableDays')->toArray();

        $date = now()->addDay();

        while (!in_array($date->format('l'), $availableDays)) {
            $date->addDay();
        }

        $this->selectedDate = $date->format('Y-m-d');
        $this->viewMonthYear = now()->format('Y-m-d');
        $this->dispatch('dateSelected', $this->selectedDate);
    }

    public function backMonth()
    {
        // Subtract 1 month from the selectedDate
        if (strtotime($this->viewMonthYear) < strtotime('0 month')) {
            return;
        }
        $this->viewMonthYear = date('Y-m-d', strtotime('-1 month', strtotime($this->viewMonthYear)));
    }

    public function forwardMonth()
    {
        // Add 1 month to the selectedDate
        if (strtotime($this->viewMonthYear) > strtotime('+1 month')) {
            return;
        }
        $this->viewMonthYear = date('Y-m-d', strtotime('+1 month', strtotime($this->viewMonthYear)));
    }

    public function selectDate($date)
    {
        $this->selectedDate = $date;
        // $this->dispatch('inputChange', 'date', $this->selectedDate);
        $this->dispatch('dateSelected', $this->selectedDate);
    }

    public function render()
    {
        // Extract month and year from the selectedDate
        $month = date('m', strtotime($this->viewMonthYear));
        $year = date('Y', strtotime($this->viewMonthYear));

        // 1. Calculate the total days in the month.
        $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        // 2. Determine the starting day of the month.
        $startDay = date('w', strtotime("$year-$month-01")); // 0 for Sunday, 6 for Saturday

        // 3. Create the grid (7x5).
        $grid = [];
        $row = [];

        // 4. Add initial empty cells for indentation.
        for ($i = 0; $i < $startDay; $i++) {
            $row[] = null; // Empty cell (null for better clarity)
        }

        // 5. Add days of the month to the grid as proper dates.
        for ($day = 1; $day <= $totalDays; $day++) {
            $date = "$year-$month-" . str_pad($day, 2, '0', STR_PAD_LEFT);
            $row[] = $date;

            // When the row is complete (7 columns), push to grid and start a new row.
            if (count($row) === 7) {
                $grid[] = $row;
                $row = [];
            }
        }

        // 6. Add any remaining cells to the last row.
        if (!empty($row)) {
            while (count($row) < 7) {
                $row[] = null; // Fill with empty cells
            }
            $grid[] = $row;
        }

        $this->calendarGrid = $grid;

        return view('livewire.date-selector');
    }
}
