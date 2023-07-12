<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDateTime = $this->faker->dateTimeBetween('-30 days', '+90 days');
        $endDateTime = $this->faker->dateTimeBetween($startDateTime, '+90 days');

        return [
            'title' => $this->faker->sentence(),
            'start_date' => $startDateTime,
            'end_date' => $endDateTime,
            'color' => $this->faker->randomElement(['#42f557','#000','#4287f5','#f03030','#e9f030']),
            'user_id' => $this->faker->numberBetween(1, 27),
        ];
    }
}
