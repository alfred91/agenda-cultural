<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'start_date' => $this->faker->date(),
            'date_text' => $this->faker->date() . ' - ' . $this->faker->date(),
            'short_description' => $this->faker->text(200),
            'price_per_person' => $this->faker->randomFloat(2, 5, 160),
            'link' => $this->faker->url,
            'long_description' => $this->faker->text(500),
            'company_id' => Company::inRandomOrder()->first()->id ?? Company::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'experiences', true),
        ];
    }
}
