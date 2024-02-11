<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a single user
        User::create([
            'prefixname' => "Mr",
            'firstname' => 'user',
            'lastname' => 'test',
            'middlename' => 'test',
            'suffixname' => 'Dr',
            'username'   => 'example',
            'email'      => 'example@test.com',
            'password'   => bcrypt('123456789'),
        ]);
    }
}
