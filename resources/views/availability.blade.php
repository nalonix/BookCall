<x-user-layout>
    <div class="p-2">
        <h1 class="text-5xl font-bold text-black dark:text-white border border-zinc-700/80 rounded-md p-2">Availability</h1>
    </div>
    <form method="POST" action="/availability" enctype="multipart/form-data" class="w-full p-2">
        @method('PUT')
        @csrf
        <div class="p-2 md:p-4 border border-zinc-700/80 rounded-md mb-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left py-2">Day</th>
                        <th class="text-left py-2">Start Time</th>
                        <th class="text-left py-2">End Time</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    @endphp

                    @foreach ($days as $day)
                    <tr class="border-b border-zinc-700/80">
                        <td class="py-4">
                            <div class="flex items-center gap-2">
                                <input type="hidden" name="availability[{{ $day }}][enabled]" value="0">
                                <input
                                    type="checkbox"
                                    id="toggle_{{ $day }}"
                                    name="availability[{{ $day }}][enabled]"
                                    value="1"
                                    @if (isset($availabilities[$day])) checked @endif
                                    class="toggle-checkbox"
                                    onchange="toggleInputs('{{ $day }}')">
                                <label for="toggle_{{ $day }}" class="text-sm font-semibold capitalize">{{ $day }}</label>
                            </div>
                        </td>
                        <td class="py-4">
                            <div id="time_inputs_{{ $day }}" @if (!isset($availabilities[$day])) style="display: none;" @endif>
                                <x-form-input
                                    type="time"
                                    id="start_time_{{ $day }}"
                                    name="availability[{{ $day }}][start_time]"
                                    value="{{ isset($availabilities[$day]) ? substr($availabilities[$day]['start_time'], 0, 5) : '' }}"
                                    step="60">
                                </x-form-input>
                            </div>
                        </td>
                        <td class="py-4">
                            <div id="time_inputs_{{ $day }}" @if (!isset($availabilities[$day])) style="display: none;" @endif>
                                <x-form-input
                                    type="time"
                                    id="end_time_{{ $day }}"
                                    name="availability[{{ $day }}][end_time]"
                                    value="{{ isset($availabilities[$day]) ? substr($availabilities[$day]['end_time'], 0, 5) : '' }}"
                                    step="60">
                                </x-form-input>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Buttons -->
            <div class="mt-6 flex justify-between gap-4">
                <a href="#" class="flex justify-center w-full px-3 py-2 rounded-md text-center text-sm font-semibold bg-zinc-900 dark:bg-zinc-700 text-white dark:text-white hover:bg-zinc-800 dark:hover:bg-zinc-600">Cancel</a>
                <button type="submit" class="w-full rounded-md bg-black dark:bg-white px-3 py-2 font-semibold text-white dark:text-black text-sm shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Availability</button>
            </div>
        </div>
    </form>

    <!-- JavaScript -->
    <script>
        function toggleInputs(day) {
            const timeInputs = document.querySelectorAll(`#time_inputs_${day}`);
            const toggleCheckbox = document.getElementById(`toggle_${day}`);

            if (toggleCheckbox.checked) {
                timeInputs.forEach(input => input.style.display = 'block');
            } else {
                timeInputs.forEach(input => input.style.display = 'none');
                // Clear the time inputs when unchecked
                document.getElementById(`start_time_${day}`).value = '';
                document.getElementById(`end_time_${day}`).value = '';
            }
        }
    </script>
</x-user-layout>