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

        return view('bookcall', ['user' => $user, 'availabilities' => $sortedAvailabilities]);
    }
}
