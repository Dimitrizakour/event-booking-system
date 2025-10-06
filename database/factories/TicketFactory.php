<?php

namespace Database\Factories;
use App\Models\Event;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    protected $model = Ticket::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['VIP', 'Standard']),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'quantity' => $this->faker->numberBetween(10, 100),
            'event_id' => Event::inRandomOrder()->first()->id,
        ];
    }
}
