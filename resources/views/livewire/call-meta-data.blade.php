<div>
    <h1>Call Meta Data</h1>
    <div class="flex flex-col max-w-xl gap-4 p-3 border">
        <div class="w-14 h-14 rounded-md bg-white">Avatar</div>

        <div class="flex flex-wrap gap-4">
            @foreach($durations as $duration)
            <label class="flex items-center cursor-pointer group">
                <input
                    type="radio"
                    name="duration"
                    value="{{ $duration }}"
                    wire:model="selectedDuration"
                    wire:change="durationChange('{{ $duration }}')"
                    class="hidden" />
                <div
                    class="w-10 h-10 flex items-center justify-center rounded-md text-sm font-medium 
                            hover:border-2 hover:border-white
                        {{ $selectedDuration == $duration ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-gray-700 dark:bg-zinc-800' }}">
                    {{ $duration }}m
                </div>
            </label>
            @endforeach
        </div>

        <label>
            Name
            {{ $name }}
            <input
                type="text"
                wire:model.defer="name"
                class="w-full h-10 p-1 bg-zinc-500/50 dark:bg-zinc-800 rounded-md outline-none 
                       focus:ring focus:ring-black dark:focus:ring-white duration-300 ease-in-out"
                placeholder="Name">
        </label>
        <label>
            Email
            {{ $email }}
            <input
                type="email"
                wire:model.defer="email"
                class="w-full h-10 p-1 bg-zinc-500/50 dark:bg-zinc-800 rounded-md outline-none 
                       focus:ring focus:ring-black dark:focus:ring-white duration-300 ease-in-out"
                placeholder="Email">
        </label>
        <label>
            Title
            {{ $title }}
            <input
                type="text"
                wire:model.defer="title"
                class="w-full h-10 p-1 bg-zinc-500/50 dark:bg-zinc-800 rounded-md outline-none 
                       focus:ring focus:ring-black dark:focus:ring-white duration-300 ease-in-out"
                placeholder="Title">
        </label>
        <label>
            Description
            {{ $description }}
            <textarea
                wire:model.defer="description"
                class="w-full min-h-24 p-1 bg-zinc-500/50 dark:bg-zinc-800 rounded-md outline-none 
                       focus:ring focus:ring-black dark:focus:ring-white duration-300 ease-in-out"
                placeholder="Description"></textarea>
        </label>
    </div>
</div>