<?php

namespace App\DTOs;

use App\Helpers\BaseDTO;

class BookingDTO extends BaseDTO
{
    public ?int $ticket_id = null;
    public ?int $user_id = null;
    public ?int $quantity = 0;
}
