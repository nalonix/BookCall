<div class="border max-h-[570px] overflow-y-scroll border-zinc-700/80 rounded-md py-2">
    @if($dayAvailability)
    <br>
    <div class="flex flex-col gap-3 w-full lg:w-fit p-3">
        @foreach($timeslots as $timeslot)
        <button wire:click="selectTime('{{ $timeslot }}')" class="{{ $timeslot == $selectedTimeslot ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-gray-700 dark:bg-zinc-800' }} px-1 py-0.5 rounded-sm border-2 border-transparent hover:border-2 hover:border-white duration-200 ease-in-out">{{ $timeslot }}</button>
        @endforeach
    </div>
    @else
    <p>User not available for this day.</p>
    @endif
    <div>
    </div>
</div>