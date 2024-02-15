<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Registration>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'asistente')->inRandomOrder()->first()->id ?? User::factory()->state(['role' => 'asistente']),
            'event_id' => Event::factory(),
            'num_tickets' => $this->faker->numberBetween(1, 10),
            'status' => $this->faker->randomElement(['received', 'confirmed', 'cancelled']),
        ];
    }
}
