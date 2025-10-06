<?php

namespace App\DTOs;

use App\Helpers\BaseDTO;

class UserDTO extends BaseDTO
{
    public ?string $name = null;
    public ?string $email = null;
    public ?string $password = null;
    public ?string $phone = null;
    public ?string $role = 'customer';
}
