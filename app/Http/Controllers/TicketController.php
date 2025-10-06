<?php

namespace App\Http\Controllers;

use App\DTOs\TicketDTO;
use App\Services\TicketService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{    use ApiResponse;

    public function __construct(private TicketService $service) {}

    public function store(Request $request, $event_id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $dto = new TicketDTO($validator->validated());
        $dto->event_id = $event_id;

         $ticket = $this->service->createTicket($dto);
        return $this->successResponse([$ticket], 'Ticket created successfully', 201);

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'quantity' => 'sometimes|integer|min:1',
            'event_id' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }


        $dto = new TicketDTO($validator->validated());
        $ticket =  $this->service->updateTicket($id, $dto);

        return $this->successResponse([$ticket], 'Ticket updated successfully', 201);

    }

    public function destroy($id)
    {
        $this->service->deleteTicket($id);
        return $this->successResponse([], 'Ticket deleted successfully', 201);
    }
}
