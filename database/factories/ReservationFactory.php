<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Reservation;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'table_number' => $this->faker->numberBetween(1, 1),
            'people_count' => $this->faker->numberBetween(1, 10),
            'start_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'end_time' => function (array $attributes) {
                return $this->faker->dateTimeBetween(
                    $attributes['start_time'],
                    Carbon::parse($attributes['start_time'])->addHours(5)
                );
            },
        ];
    }
}
