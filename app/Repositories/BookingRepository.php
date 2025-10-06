<?php

namespace App\Repositories;

use App\DTOs\BookingDTO;
use App\Models\Booking;

class BookingRepository
{
    public function create(BookingDTO $dto)
    {
        return Booking::create([
            'ticket_id' => $dto->ticket_id,
            'user_id' => $dto->user_id,
            'quantity' => $dto->quantity,
            'status' => 'pending',
        ]);
    }

    public function listByUser(int $user_id)
    {
        return Booking::with('ticket.event')
            ->where('user_id', $user_id)
            ->get();
    }

    public function cancel(int $id, int $user_id): bool
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', $user_id)
            ->firstOrFail();

        $booking->status = 'cancelled';
        $booking->save();

        return true;
    }
}
