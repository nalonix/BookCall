<div class="w-full md:p-5">
    <div class="flex flex-col items-end border w-fit mx-auto rounded-md p-4 ">
        <div class="flex flex-col lg:flex-row gap-4 rounded-md mx-auto mt-4 w-fit">
            <livewire:call-meta-data />
            <livewire:date-selector />
            <livewire:time-selector />
        </div>
        <div class="mt-2">
            <button wire:click="bookCall" class="block w-48 py-1 rounded-sm text-center text-lg font-semibold cursor-pointer duration-100 ease-in-out bg-black dark:bg-white text-black dark:text-zinc-900">Book Call</button>
        </div>
    </div>
</div>