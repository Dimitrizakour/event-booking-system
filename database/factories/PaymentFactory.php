<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        $booking = Booking::inRandomOrder()->first();
        return [
            'booking_id' => $booking->id,
            'amount' => $booking->quantity * $booking->ticket->price,
            'status' => $this->faker->randomElement(['success', 'failed', 'refunded']),
        ];
    }
}

