<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HorizonSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@horizon.test'],
            ['name' => 'Admin', 'password' => Hash::make('password'), 'is_admin' => true]
        );

        Plan::updateOrCreate(
            ['code' => 'premium_monthly'],
            [
                'name' => 'Premium Monthly',
                'price_cents' => 999,
                'currency' => 'USD',
                'interval' => 'month',
                'interval_count' => 1,
                'description' => 'Download any video while active.',
                'is_active' => true,
            ]
        );
    }
}