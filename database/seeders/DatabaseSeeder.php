<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DoctorSchedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            "email"=> 'ari@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('ari1234'),
            'phone'=> '123456789',
        ]);

        // seeder profile_clinic manual
        \App\Models\ProfileClinic::factory()->create([
            'name' => 'Ari Clinic',
            'address' => 'Jl. Ahmad Wongso',
            'phone' => '085787405635',
            'email' => 'dr.ari@gmail.com',
            'doctor_name' => 'Dr. Ari',
            'unique_code' => '123456',
        ]);

        // call
        $this->call([
            DoctorSeeder::class,
            DoctorScheduleSeeder::class,
        ]);
    }
}
