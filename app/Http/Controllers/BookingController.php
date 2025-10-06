<?php

namespace App\Http\Controllers;

use App\DTOs\BookingDTO;
use App\Services\BookingService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    use ApiResponse;

    public function __construct(private BookingService $service) {}

    public function store(Request $request, $ticket_id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }
        $dto = new BookingDTO($validator->validated());
        $dto->ticket_id = $ticket_id;
        $dto->user_id = $request->user()->id;

        $booking = $this->service->createBooking($dto);

        return $this->successResponse([$booking], 'Booking created successfully', 201);
    }

    public function index(Request $request)
    {
        $bookings = $this->service->listUserBookings($request->user()->id);
        return $this->successResponse([$bookings]);
    }

    public function cancel($id, Request $request)
    {
        $this->service->cancelBooking($id, $request->user()->id);
        return $this->successResponse([], 'Booking cancelled successfully');
    }
}
