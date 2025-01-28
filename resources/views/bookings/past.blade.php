<x-user-layout>
    Here are past bookings.
    @if($bookings->isEmpty())
    <p>No past bookings found.</p>
    @else
    @foreach($bookings as $booking)
    <div>
        <p>{{ $booking->title }}</p>
        <p>{{ $booking->client_name }} - {{ $booking->client_email }}</p>
        <p>{{ $booking->date }}</p>
    </div>
    @endforeach
    @endif
</x-user-layout>