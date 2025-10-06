<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::factory()->admin()->count(2)->create();
        User::factory()->organizer()->count(3)->create();
        User::factory()->customer()->count(10)->create();

        // Events
        Event::factory()->count(5)->create();

        // Tickets
        Ticket::factory()->count(15)->create();

        // Bookings
        Booking::factory()->count(20)->create();

        // Payments
        Payment::factory()->count(20)->create();
    }
}
