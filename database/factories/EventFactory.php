<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'date' => $this->faker->dateTimeBetween('+1 week', '+1 year')->format('Y-m-d'),
            'time' => $this->faker->time,
            'description' => $this->faker->paragraph,
            'city' => $this->faker->city,
            'address' => $this->faker->address,
            'status' => $this->faker->randomElement(['created', 'cancelled', 'finished']),
            'max_capacity' => $this->faker->numberBetween(20, 1000),
            'type' => $this->faker->randomElement(['online', 'presencial']),
            'max_tickets_per_person' => $this->faker->numberBetween(1, 10),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'user_id' => User::where('role', 'creador_eventos')->inRandomOrder()->first()->id ?? User::factory()->state(['role' => 'creador_eventos']),
            'image' => $this->faker->imageUrl(640, 480, 'events', true),
        ];
    }
}
