<?php

namespace App\Repositories;

use App\DTOs\TicketDTO;
use App\Models\Ticket;

class TicketRepository
{
    public function create(TicketDTO $dto)
    {
        return Ticket::create((array)$dto);
    }

    public function update($id, TicketDTO $dto)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update((array)$dto);
        return $ticket;
    }

    public function delete($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();
    }
}
