<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserRank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $rank = 1;

        foreach ($users as $user) {
            UserActivity::factory()
                ->count(rand(5, 15))
                ->create([
                    'user_id' => $user->id
                ]);

            UserRank::factory()->create([
                'user_id' => $user->id
            ]);
        }
    }
}
