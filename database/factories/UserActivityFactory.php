<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserActivity>
 */
class UserActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $activityTypes = ['walking', 'running', 'cycling'];

        return [
            'user_id' => null,
            'type' => $this->faker->randomElement($activityTypes),
            'points' => 20,
            'performed_at' => Carbon::now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
        ];
    }
}
