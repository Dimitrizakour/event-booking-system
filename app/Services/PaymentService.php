<?php

namespace App\Services;

use App\DTOs\PaymentDTO;
use App\Repositories\PaymentRepository;

class PaymentService
{
    public function __construct(private PaymentRepository $repo) {}

    /**
     * Simulate a payment for a booking.
     */
    public function processPayment(PaymentDTO $dto)
    {
        $dto->status = rand(1, 10) <= 9 ? 'success' : 'failed';

        $payment = $this->repo->create($dto);

        return $payment;
    }

    public function getPayment(int $id)
    {
        $payment = $this->repo->findById($id);
        if (!$payment) return null;

        return $payment->toArray();
    }
}
