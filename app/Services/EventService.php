<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Repositories\EventRepository;
use Illuminate\Support\Facades\Cache;

class EventService
{
    public function __construct(private EventRepository $repo) {}

    public function listEvents(array $filters)
    {
        $page = $filters['page'] ?? 1;
        $perPage = $filters['per_page'] ?? 10;
        $search = $filters['search'] ?? '';
        $date = $filters['date'] ?? '';
        $location = $filters['location'] ?? '';

        // Build a unique cache key
        $cacheKey = "events_page_{$page}_perPage_{$perPage}_search_{$search}_date_{$date}_location_{$location}";

        // Cache
        return Cache::remember($cacheKey, 60, function () use ($filters, $perPage) {
            return $this->repo->getAll($filters);
        });
    }

    public function getEvent($id)
    {
        return $this->repo->findById($id);
    }

    public function createEvent(EventDTO $dto, $userId)
    {
        $event =  $this->repo->create(array_merge($dto->toArray(), ['created_by' => $userId]));

        return $event;
    }

    public function updateEvent($id, EventDTO $dto, $userId)
    {
        $event = $this->repo->updateById($id, array_merge($dto->toArray(), ['created_by' => $userId]));

        return $event;
    }

    public function deleteEvent($id, $userId)
    {
        $event = $this->repo->deleteById($id, $userId);

        // Clear cached event lists
        Cache::tags('events')->flush();

        return $event;
    }
}
