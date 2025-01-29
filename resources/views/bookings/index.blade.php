<x-user-layout>
    <div class="p-2">
        <h1 class="text-5xl font-bold text-black dark:text-white border border-zinc-700/80 rounded-md p-2">Bookings</h1>
    </div>
    <div class="flex flex-col gap-5 max-h-screen overflow-y-scroll p-6">
        @if($bookings->isEmpty())
        <p>No unconfirmed bookings found.</p>
        @else
        @foreach($bookings as $booking)
        <div class="border rounded-md px-2.5 py-3">
            <div class="top">
                <h3 class="text-2xl font-semibold text-black dark:text-white">{{ ucfirst($booking->title) }}</h3>
                <p class="text-zinc-300">{{ $booking->client_name }} - {{ $booking->client_email }}</p>
            </div>
            <div class="my-2">
                <p class="text-lg text-zinc-200">{{ date('D, d M', strtotime($booking->date)) }}</p>
                <p class="text-zinc-300">{{ $booking->start_time }} - {{ $booking->end_time }}</p>
            </div>
            <p>{{ $booking->description }}</p>

            <!-- Bottom buttons -->
            <div class="flex gap-3 rounded-md mt-2">

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
                                class="px-4 py-1 bg-zinc-300 text-gray-900 font-semibold rounded-md hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-1 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700">
                                Confirm
                            </button>
                        </div>
                    </form>
                </x-confirmation-popup>

            </div>
        </div>
        @endforeach
        @endif

    </div>

</x-user-layout>