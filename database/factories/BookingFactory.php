<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        $ticket = Ticket::inRandomOrder()->first();
        return [
            'user_id' => User::where('role', 'customer')->inRandomOrder()->first()->id,
            'ticket_id' => $ticket->id,
            'quantity' => $this->faker->numberBetween(1, 5),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}

