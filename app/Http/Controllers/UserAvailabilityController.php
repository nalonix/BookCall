<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Availability;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAvailabilityController extends Controller
{
    public function index()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        $user = Auth::user();

        if (!$user instanceof User) {
            abort(500, 'User instance not found');
        }

        // Fetch availabilities and transform them into an associative array
        $availabilities = Availability::where('user_id', $user->id)
            ->get()
            ->keyBy('day') // Key the collection by the 'day' field
            ->map(function ($availability) {
                return [
                    'enabled' => true, // Since the record exists, the day is enabled
                    'start_time' => $availability->start_time,
                    'end_time' => $availability->end_time,
                ];
            })
            ->toArray();

        return view('availability', [
            'availabilities' => $availabilities,
        ]);
    }

    public function update(Request $request)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (!$user instanceof User) {
            abort(500, 'User instance not found');
        }

        // Validate the request data
        $validatedData = $request->validate([
            'availability' => 'required|array',
            'availability.*.enabled' => 'nullable|in:0,1',
            'availability.*.start_time' => 'nullable|required_if:availability.*.enabled,1|date_format:H:i',
            'availability.*.end_time' => 'nullable|required_if:availability.*.enabled,1|date_format:H:i|after:availability.*.start_time',
        ], [
            'availability.*.enabled.in' => 'The :attribute field must be true or false.',
            'availability.*.start_time.required_if' => 'The start time is required when a day is enabled.',
            'availability.*.end_time.required_if' => 'The end time is required when a day is enabled.',
            'availability.*.end_time.after' => 'The end time must be after the start time.',
        ]);


        // Clear existing availabilities for the user
        Availability::where('user_id', $user->id)->delete();

        // Insert updated availabilities
        foreach ($validatedData['availability'] as $day => $data) {
            if (isset($data['enabled']) && $data['enabled']) {
                Availability::create([
                    'day' => $day,
                    'start_time' => $data['start_time'],
                    'end_time' => $data['end_time'],
                    'user_id' => $user->id,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Availability updated successfully.');
    }
}
