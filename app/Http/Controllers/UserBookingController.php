<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    // List unconfirmed, uncancelled, and not completed bookings
    public function index()
    {
        $bookings = Booking::query()
            ->where('user_id', Auth::id())
            ->where('confirmed', false)
            ->where('canceled', false)
            ->where('complete', false)
            ->whereDate('date', '>=', now()->toDateString())
            ->get();

        return view('bookings.index', compact('bookings'));
    }

    // List confirmed, uncancelled, and not completed bookings
    public function confirmed()
    {
        $bookings = Booking::query()
            ->where('user_id', Auth::id())
            ->where('confirmed', true)
            ->where('canceled', false)
            ->where('complete', false)
            ->whereDate('date', '>=', now()->toDateString())
            ->get();

        return view('bookings.confirmed', compact('bookings'));
    }

    // List past meetings (completed, canceled, or missed)
    public function past()
    {
        $bookings = Booking::query()
            ->where('user_id', Auth::id())
            ->where(function ($query) {
                $query->where('complete', true)
                    ->orWhere('canceled', true)
                    ->orWhere('date', '<', now()->toDateString());
            })
            ->get()
            ->map(function ($booking) {
                // Add "missed" attribute dynamically
                $booking->missed = $booking->date < now() && !$booking->complete && !$booking->canceled;
                return $booking;
            });

        return view('bookings.past', compact('bookings'));
    }

    // Update a booking status to "complete"
    public function complete(Booking $booking)
    {
        $booking->update(['complete' => true]);

        return redirect()->back()->with('success', 'Booking marked as completed.');
    }

    // Update a booking status to "confirmed" and add a meeting link
    public function confirm(Booking $booking, Request $request)
    {
        $request->validate([
            'meeting_link' => 'required|string',
        ]);

        $booking->update([
            'confirmed' => true,
            'meeting_link' => $request->meeting_link,
        ]);

        return redirect()->back()->with('success', 'Booking confirmed successfully.');
    }

    // Update a booking status to "canceled"
    public function cancel(Booking $booking)
    {
        $booking->update(['canceled' => true]);

        return redirect()->back()->with('success', 'Booking canceled successfully.');
    }
}
