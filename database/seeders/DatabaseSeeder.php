<?php

namespace Database\Seeders;

use App\Models\Availability;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 10 users, each with 3 availabilities
        User::factory(10)
            ->has(
                Availability::factory()
                    ->count(7)
                    ->state(function (array $attributes, User $user) {
                        return [
                            'day' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'][array_rand(range(0, 6))],
                        ];
                    })
            )
            ->create();
    }
}
