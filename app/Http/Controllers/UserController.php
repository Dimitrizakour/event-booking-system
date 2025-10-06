<?php

namespace App\Http\Controllers;

use App\DTOs\UserDTO;
use App\Services\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use ApiResponse;
    public function __construct(private UserService $service) {}

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'role' => 'nullable|in:admin,organizer,customer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = $this->service->register(new UserDTO($validator->validated()));

        return $this->successResponse([
            'user' => $user
        ], 'User registered successfully', 201);    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $data = $this->service->login(new UserDTO($validator->validated()));
            return $this->successResponse($data, 'Login successful');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->errorResponse('Login failed', $e->errors(), 401);
        }
    }

    public function logout(Request $request)
    {
        $this->service->logout($request->user());
        return $this->successResponse([], 'Logout successful');    }

    public function me(Request $request)
    {
        return $this->successResponse([
            'user' => $request->user()
        ], 'Current user retrieved');
    }
}
