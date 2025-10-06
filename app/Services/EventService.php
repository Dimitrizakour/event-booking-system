<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Repositories\EventRepository;

class EventService
{
    public function __construct(private EventRepository $repo) {}

    public function listEvents(array $filters)
    {
        return $this->repo->getAll($filters);
    }

    public function getEvent($id)
    {
        return $this->repo->findById($id);
    }

    public function createEvent(EventDTO $dto, $userId)
    {
        return $this->repo->create(array_merge($dto->toArray(), ['created_by' => $userId]));
    }

    public function updateEvent($id, EventDTO $dto, $userId)
    {
        return $this->repo->updateById($id, array_merge($dto->toArray(), ['created_by' => $userId]));
    }

    public function deleteEvent($id, $userId)
    {
        return $this->repo->deleteById($id, $userId);
    }
}
