<?php

namespace App\DTOs;

use App\Helpers\BaseDTO;

class EventDTO extends BaseDTO
{
    public ?string $title = null;
    public ?string $description = null;
    public ?string $date = null;
    public ?string $location = null;
}
