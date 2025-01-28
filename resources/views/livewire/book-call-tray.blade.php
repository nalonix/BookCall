<div>
    <h1 class="text-4xl font-bold">
        Book a call
    </h1>
    <livewire:call-meta-data />
    {{ $formData['date'] }}
    <livewire:date-selector />
    {{ $formData['time'] }}
    <livewire:time-selector />



    <div>
        <button wire:click="bookCall">Book Call</button>
    </div>
</div>