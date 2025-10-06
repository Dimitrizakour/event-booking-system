<?php

namespace App\Http\Controllers;

use App\DTOs\PaymentDTO;
use App\Services\PaymentService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    use ApiResponse;

    public function __construct(private PaymentService $service) {}

    /**
     * POST /api/bookings/{id}/payment
     */
    public function pay(Request $request, $booking_id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $dto = new PaymentDTO($validator->validated());
        $dto->booking_id = $booking_id;

        $payment = $this->service->processPayment($dto);

        return $this->successResponse([$payment], 'Payment processed successfully', 201);
    }

    /**
     * GET /api/payments/{id}
     */
    public function show($id)
    {
        $payment = $this->service->getPayment($id);

        if (!$payment) {
            return $this->errorResponse([], 'Payment not found', 404);
        }

        return $this->successResponse((array)$payment, 'Payment retrieved successfully');
    }
}
