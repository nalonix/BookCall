<x-layout>
    <h1 class="text-red-500">Book a Call with {{ $user->first_name }} {{ $user->last_name }}</h1>

    <section>
        <livewire:book-call-tray />
    </section>
    <ul>
        @foreach ($availabilities as $availability)
        <li>
            {{ $availability->day }}: {{ $availability->start_time }} - {{ $availability->end_time }}
        </li>
        @endforeach
    </ul>
</x-layout>