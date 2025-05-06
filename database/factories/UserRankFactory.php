<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRank>
 */
class UserRankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $periodType = $this->faker->randomElement(['day', 'month', 'year', 'all']);

        return [
            'user_id' => null,
            'period_type' => $periodType,
            'total_points' => $this->faker->numberBetween(20, 1000),
            'rank' => $this->faker->numberBetween(1, 10),
        ];
    }
}
