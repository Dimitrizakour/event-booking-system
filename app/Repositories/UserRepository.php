<?php

namespace App\Repositories;

use App\DTOs\UserDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function create(UserDTO $dto): User
    {
        return User::create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => bcrypt($dto->password),
            'phone' => $dto->phone,
            'role' => $dto->role,
        ]);
    }
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}
