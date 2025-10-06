<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Booking;

class PreventDoubleBooking
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $ticketId = $request->route('id');

        $exists = Booking::where('user_id', $user->id)
            ->where('ticket_id', $ticketId)
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'You have already booked this ticket',
                'timestamp' => now()->format('Y-m-d H:i:s')
            ], 422);
        }

        return $next($request);
    }
}
