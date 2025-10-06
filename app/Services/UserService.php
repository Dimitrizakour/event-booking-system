<?php

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\UserRepository;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserService
{
    public function __construct(private UserRepository $repo) {}

    public function register(UserDTO $dto)
    {
        return $this->repo->create($dto);
    }

    public function login(UserDTO $dto)
    {
        $user = $this->repo->findByEmail($dto->email);

        if (!$user || !Hash::check($dto->password, $user->password)) {
            throw new HttpResponseException(response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
                'errors' => [],
                'timestamp' => now()->format('Y-m-d, H:i:s'),
            ], 401));
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout($user)
    {
        $user->currentAccessToken()->delete();
        return true;
    }
}
