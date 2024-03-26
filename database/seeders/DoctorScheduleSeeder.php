<?php

namespace Database\Seeders;

use Carbon\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DoctorSchedule;

class DoctorScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create Doctor Schedule
        \App\Models\Doctor::create([
            'doctor_id' => 1,
            'day' => 'monday',
            'time' => '08:00 - 12:00',
        ]);

        // Auto Generate Doctor Schedule
        \App\Models\Doctor::all()->each(function ($doctor) {
                \App\Models\DoctorSchedule::factory()->count(3)->create([
                    'doctor_id' => $doctor->id
                ]);
        });
    }
}
