<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BookCallController extends Controller
{
    //
    public function index(Request $request)
    {
        $username = $request->route('username');

        // Fetch user and availabilities
        $user = User::where('username', $username)->firstOrFail();
        $availabilities = $user->availabilities;

        // Define day order
        $dayOrder = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Sort availabilities
        $sortedAvailabilities = $availabilities->sortBy(function ($availability) use ($dayOrder) {
            return array_search($availability->day, $dayOrder);
        });

        // Transform sorted availabilities into the desired format
        $dailyTimeRange = [];
        foreach ($sortedAvailabilities as $availability) {
            $day = $availability->day; // e.g., "Monday"
            $startTime = $availability->start_time; // e.g., "09:00:00"
            $endTime = $availability->end_time; // e.g., "17:00:00"

            // Convert times to a more readable format (optional)
            $startTime = date('H:i', strtotime($startTime));
            $endTime = date('H:i', strtotime($endTime));

            // Store in the dailyTimeRange array
            $dailyTimeRange[$day] = [
                'start_time' => $startTime,
                'end_time' => $endTime,
            ];
        }

        // Store user data on global session
        // session(['user_id' => $user->id]);
        // Store user data in the session
        session([
            'user_id' => $user->id,
            'user_name' => $user->username,
            'user_avatar' => $user->avatar,
            'buffer_time' => $user->buffer_time,
            'durations' => $user->durations,
            'availableDays' => $sortedAvailabilities->pluck('day')->unique(),
            'dailyTimeRange' => $dailyTimeRange,
        ]);

        return view('bookcall', ['user_id' => $user->id]);
    }
}
