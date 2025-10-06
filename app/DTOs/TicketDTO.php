<?php

namespace App\DTOs;

use App\Helpers\BaseDTO;

class TicketDTO extends BaseDTO
{
    public ?string $type = null;
    public ?float $price = null;
    public ?int $quantity = null;
    public ?int $event_id = null;
}
