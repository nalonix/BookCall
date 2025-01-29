<div class="h-fit border border-zinc-700/80 rounded-md p-2">
    <div class="flex flex-col  gap-4 p-3">
        <div class="preview w-24 h-24 bg-white rounded-md overflow-hidden border border-gray-300">
            <img id="avatar-preview" src="{{ asset('storage/' . session('user_avatar')) }}"
                alt="Profile Picture" class="w-full h-full object-cover">
        </div>

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
                wire:model.lazy="name"
                wire:change="onChange('name', $event.target.value)"
                class="w-full h-10 p-1 bg-zinc-500/50 dark:bg-zinc-800 rounded-md outline-none 
                       focus:ring focus:ring-black dark:focus:ring-white duration-300 ease-in-out"
                placeholder="Name">
        </label>
        <label>
            Email
            {{ $email }}
            <input
                type="email"
                wire:model.lazy="email"
                wire:change="onChange('email', $event.target.value)"
                class="w-full h-10 p-1 bg-zinc-500/50 dark:bg-zinc-800 rounded-md outline-none 
                       focus:ring focus:ring-black dark:focus:ring-white duration-300 ease-in-out"
                placeholder="Email">
        </label>
        <label>
            Title
            {{ $title }}
            <input
                type="text"
                wire:model.lazy="title"
                wire:change="onChange('title', $event.target.value)"
                class="w-full h-10 p-1 bg-zinc-500/50 dark:bg-zinc-800 rounded-md outline-none 
                       focus:ring focus:ring-black dark:focus:ring-white duration-300 ease-in-out"
                placeholder="Title">
        </label>
        <label>
            Description
            {{ $description }}
            <textarea
                wire:model.lazy="description"
                wire:change="onChange('description', $event.target.value)"
                class="w-full min-h-24 p-1 bg-zinc-500/50 dark:bg-zinc-800 rounded-md outline-none 
                       focus:ring focus:ring-black dark:focus:ring-white duration-300 ease-in-out"
                placeholder="Description"></textarea>
        </label>
    </div>
</div>