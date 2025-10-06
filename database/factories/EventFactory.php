<?php

namespace Database\Factories;
use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeBetween('+1 week', '+2 months'),
            'location' => $this->faker->city,
            'created_by' => User::where('role', 'organizer')->inRandomOrder()->first()->id,
        ];
    }
}
