<?php

namespace App\DTOs;

use App\Helpers\BaseDTO;

class PaymentDTO extends BaseDTO
{
    public ?int $booking_id = null;
    public ?float $amount = null;
    public ?string $status = null;
}
