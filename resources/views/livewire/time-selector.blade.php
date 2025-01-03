<div>
    <h1>Time selector</h1>
    <p class="text-blue-500">{{ $selectedTimeslot }}</p>
    {{ date('l', strtotime($selectedDate)) }}
    {{ date('j', strtotime($selectedDate)) }}
    @if($dayAvailability)
    {{ $dayAvailability->start_time }}
    {{ $dayAvailability->end_time }}
    <br>
    <div class="flex flex-col gap-3 w-fit p-3 border">
        @foreach($timeslots as $timeslot)
        <button wire:click="selectTime('{{ $timeslot }}')" class="{{ $timeslot == $selectedTimeslot ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-gray-700 dark:bg-zinc-800' }} px-1 py-0.5 rounded-sm border-2 border-transparent hover:border-2 hover:border-white duration-200 ease-in-out">{{ $timeslot }}</button>
        @endforeach
    </div>
    @else
    <p>User not available for this day.</p>
    @endif
    <p>Duration: {{ $duration }}</p>
    <div>
    </div>
</div>