<?php

namespace App\Repositories;

use App\DTOs\PaymentDTO;
use App\Models\Payment;

class PaymentRepository
{
    public function create(PaymentDTO $dto): Payment
    {
        return Payment::create([
            'booking_id' => $dto->booking_id,
            'amount' => $dto->amount,
            'status' => $dto->status,
        ]);
    }

    public function findById(int $id): ?Payment
    {
        return Payment::find($id);
    }
}
