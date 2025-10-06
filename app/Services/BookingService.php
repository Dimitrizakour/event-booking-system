<?php

namespace App\Services;

use App\DTOs\BookingDTO;
use App\Repositories\BookingRepository;

class BookingService
{
    public function __construct(private BookingRepository $repo) {}

    public function createBooking(BookingDTO $dto)
    {
        return $this->repo->create($dto);
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
