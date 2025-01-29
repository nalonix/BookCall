<div>
    <div>
        <div class="flex flex-row gap-4 border-2 border-black">
            <h2 class="text-3xl font-bold ">
                {{date('F', strtotime($viewMonthYear))}} {{date('Y', strtotime($viewMonthYear))}}
            </h2>
        </div>
        <div class="flex flex-row justify-between gap-4 mt-2">
            <button wire:click="backMonth" class="bg-zinc-700/50 hover:bg-zinc-800/50 px-2 py-1 rounded-md">Return</button>
            <button wire:click="forwardMonth" class="bg-zinc-700/50 hover:bg-zinc-800/50 px-2 py-1 rounded-md">Next</button>
        </div>
    </div>
    <div>
        <table class="border-separate border-spacing-2">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($calendarGrid as $row)
                <tr>
                    @foreach($row as $cell)
                    <td class="min-w-12 h-12 bg-gray-700 dark:bg-zinc-800 rounded-md overflow-hidden">
                        @if($cell && in_array(date('l', strtotime($cell)), session('availableDays')->toArray()) && strtotime($cell) >= strtotime('tomorrow'))
                        <button wire:click="selectDate('{{ $cell }}')" class="{{ $cell == $selectedDate ? 'bg-black text-white dark:bg-white dark:text-black' : '' }} w-full h-full border-2 border-transparent hover:border-2 hover:border-white rounded-md duration-200 ease-in-out">
                            {{ date('j', strtotime($cell)) }}
                        </button>
                        @elseif($cell)
                        <button class="w-full h-full border-2 border-transparent rounded-md cursor-default opacity-40">
                            {{ date('j', strtotime($cell)) }}
                        </button>
                        @endif
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>