<?php

namespace App\Http\Controllers;

use App\DTOs\EventDTO;
use App\Services\EventService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    use ApiResponse;

    public function __construct(private EventService $service) {}

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'page'       => 'nullable|integer|min:1',
            'title'      => 'nullable|string|max:255',
            'location'   => 'nullable|string|max:255',
            'date'       => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $events = $this->service->listEvents($validator->validated());
        $data = [
            'data' => $events->items(),
            'pagination' => [
                'total'        => $events->total(),
                'per_page'     => $events->perPage(),
                'current_page' => $events->currentPage(),
                'last_page'    => $events->lastPage(),
            ]
        ];

        return $this->successResponse($data);
    }

    public function show($id)
    {
        $event = $this->service->getEvent($id);
        return $event ? $this->successResponse([$event]) : $this->errorResponse('Event not found', 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $dto = new EventDTO($validated);
        $event = $this->service->createEvent($dto, $request->user()->id); // pass creator id
        return $this->successResponse([$event], 'Event created successfully', 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'sometimes|required|date',
            'location' => 'sometimes|required|string|max:255',
        ]);

        $dto = new EventDTO($validated);
        $event = $this->service->updateEvent($id, $dto, $request->user()->id);
        return $event ? $this->successResponse([$event], 'Event updated') : $this->errorResponse([],'Event not found or forbidden', 404);
    }

    public function destroy(Request $request, $id)
    {
        $deleted = $this->service->deleteEvent($id, $request->user()->id);
        return $deleted ? $this->successResponse([], 'Event deleted') : $this->errorResponse([],'Event not found or forbidden', 404);
    }
}
