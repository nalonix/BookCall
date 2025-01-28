<x-user-layout>
    Here are confirmed bookings.
    @if($bookings->isEmpty())
    <p>No confirmed bookings found.</p>
    @else
    @foreach($bookings as $booking)
    <div>
        <p>{{ $booking->title }}</p>
        <p>{{ $booking->client_name }} - {{ $booking->client_email }}</p>
        <p>{{ $booking->date }}</p>
        <p>{{ $booking->start_time }} - {{ $booking->end_time }}</p>
        <p>{{ $booking->description }}</p>


        <!-- Bottom buttons -->
        <div class="flex flex-col rounded-md p-2 pt-0">
            <a href="{{ $booking->meeting_link }}" target="_blank" class="block w-32 py-1 rounded-sm text-center text-sm font-bold cursor-pointer duration-100 ease-in-out bg-zinc-400/25 text-black dark:text-gray-200">
                Launch Meeting
            </a>

            <form method="POST" action="/bookings/{{ $booking->id }}/complete">
                @csrf
                @method('PATCH')
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                <button class="block w-32 py-1 rounded-sm text-center text-sm font-bold cursor-pointer duration-100 ease-in-out bg-black dark:bg-white text-black dark:text-zinc-900">
                    Complete
                </button>
            </form>
        </div>
    </div>
    @endforeach
    @endif
</x-user-layout>