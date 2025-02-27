<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Availability;
use Illuminate\Database\Seeder;

class DriversTableSeeder extends Seeder
{
    public function run()
    {
        $driver = User::create([
            'name' => 'John Doe',
            'email' => 'driver@example.com',
            'password' => bcrypt('password'),
            'photo' => 'drivers/john.jpg',
            'role' => 'driver',
            'phone' => '1234567890',
        ]);

        Availability::create([
            'driverID' => $driver->id,
            'From' => now(),
            'To' => now()->addHours(8),
        ]);

        $driver2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('password'),
            'photo' => 'drivers/jane.jpg',
            'role' => 'driver',
            'phone' => '0987654321',
        ]);

        Availability::create([
            'driverID' => $driver2->id,
            'From' => now(),
            'To' => now()->addHours(6),
        ]);
    }
}