<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Create the admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'phone' => '1234567890', // You can set a default phone number
            'password' => Hash::make('Admin@123'), // Hash the password
            'image' => 'default.png', // Set a default profile picture if needed
            'role' => 'admin', // Set the role to admin
        ]);

        // Create the regular user
        User::create([
            'name' => 'User ',
            'email' => 'user@gmail.com',
            'phone' => '0987654321', // You can set a default phone number
            'password' => Hash::make('User@123'), // Hash the password
            'image' => 'default.png', // Set a default profile picture if needed
            'role' => 'user', // Set the role to user
        ]);

        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
