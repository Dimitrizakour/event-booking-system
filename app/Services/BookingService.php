<?php

namespace App\Services;

use App\DTOs\BookingDTO;
use App\Notifications\BookingConfirmed;
use App\Repositories\BookingRepository;

class BookingService
{
    public function __construct(private BookingRepository $repo) {}

    public function createBooking(BookingDTO $dto)
    {
        $booking= $this->repo->create($dto);
        $booking->user->notify(new BookingConfirmed($booking));
        return $booking;
    }

    public function listUserBookings(int $user_id)
    {
        return $this->repo->listByUser($user_id);
    }

    public function cancelBooking(int $id, int $user_id): bool
    {
        return $this->repo->cancel($id, $user_id);
    }
}
