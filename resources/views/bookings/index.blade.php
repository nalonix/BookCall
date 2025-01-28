<x-user-layout>
    This is index bookings or as I like to say, confirmed bookings.
    @if($bookings->isEmpty())
    <p>No unconfirmed bookings found.</p>
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

            <!-- Confirm Booking Button -->
            <x-confirmation-popup
                id="confirm-booking-{{ $booking->id }}"
                triggerText="Confirm Booking"
                popupHeader="Confirm Booking"
                popupMessage="Fill out the meeting link and confirm the booking."
                type="primary">
                <!-- Custom Form Slot -->
                <form id="confirmation-form" method="POST" action="/bookings/{{ $booking->id }}/confirm">
                    @csrf
                    @method('PATCH')

                    <!-- Additional Inputs (Optional) -->
                    <div class="mt-4">
                        <label for="meeting_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meeting Link</label>
                        <input type="text" id="meeting_link" name="meeting_link" class="mt-1 p-1 block w-full rounded-sm border-gray-300 shadow-sm dark:bg-zinc-700 dark:border-zinc-600" required>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-4 flex justify-end space-x-3">
                        <button id="cancel-btn-confirm-booking-{{ $booking->id }}" type="button"
                            class="block w-32 py-1 rounded-sm text-center text-sm font-bold cursor-pointer duration-100 ease-in-out bg-red-700/25 text-red-700 dark:text-red-700">
                            Cancel
                        </button>
                        <button type="submit"
                            class="block w-32 py-1 rounded-sm text-center text-sm font-bold cursor-pointer duration-100 ease-in-out ">
                            Confirm
                        </button>
                    </div>
                </form>
            </x-confirmation-popup>

            <!-- Cancel Booking Button -->
            <x-confirmation-popup
                id="cancel-booking-{{ $booking->id }}"
                type="secondary"
                triggerText="Cancel Booking"
                popupHeader="Cancel Booking"
                popupMessage="Are you sure you want to cancel this booking? This action cannot be undone.">
                <!-- Custom Form Slot -->

                <form id="confirmation-form" method="POST" action="/bookings/{{ $booking->id }}/cancel">
                    @csrf
                    @method('PATCH')

                    <!-- Buttons -->
                    <div class="mt-4 flex justify-end space-x-3">
                        <button id="cancel-btn-cancel-booking-{{ $booking->id }}" type="button"
                            class="px-4 py-1 bg-zinc-300 text-gray-900 font-semibold rounded-md hover:bg-gray-400">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-1 bg-red-600 text-white font-semibold rounded-md hover:bg-red-700">
                            Confirm
                        </button>
                    </div>
                </form>
            </x-confirmation-popup>

        </div>
    </div>
    @endforeach
    @endif
</x-user-layout>