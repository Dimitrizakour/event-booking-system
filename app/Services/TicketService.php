<?php

namespace App\Services;
use App\DTOs\TicketDTO;
use App\Repositories\TicketRepository;

class TicketService
{
    public function __construct(private TicketRepository $repo) {}

    public function createTicket(TicketDTO $dto)
    {
        $ticket = $this->repo->create($dto);
        return $ticket;
    }

    public function updateTicket($id, TicketDTO $dto)
    {
        $ticket = $this->repo->update($id, $dto);
        return $ticket;
    }

    public function deleteTicket($id)
    {
        $this->repo->delete($id);
        return true ;
    }
}
