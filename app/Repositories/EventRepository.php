<?php

namespace App\Repositories;

use App\Models\Event;
use function Laravel\Prompts\search;

class EventRepository
{
    public function getAll(array $filters)
    {
        $query = Event::query()
            ->searchByTitle($filters['title'] ?? null)
            ->filterByDate($filters['date'] ?? null)//
            ->searchByLocation($filters['location'] ?? null);

        if (!empty($filters['location'])) {
            $query->where('location', 'like', "%{$filters['location']}%");
        }

        return $query->paginate(10);
    }

    public function findById($id)
    {
        return Event::with('tickets')->find($id);
    }

    public function create(array $data)
    {
        return Event::create($data);
    }

    public function updateById($id, array $data)
    {
        $event = Event::find($id);
        if (!$event) return null;

        if ($event->created_by != $data['created_by']) return null;

        $event->update($data);
        return $event;
    }

    public function deleteById($id, $userId)
    {
        $event = Event::find($id);
        if (!$event || $event->created_by != $userId) return false;
        $event->delete();
        return true;
    }
}
