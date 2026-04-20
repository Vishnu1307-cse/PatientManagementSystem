<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create an Admin User
        User::factory()->create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Create a Receptionist User
        User::factory()->create([
            'name' => 'Front Desk Receptionist',
            'email' => 'receptionist@example.com',
            'password' => Hash::make('password'),
            'role' => 'receptionist',
        ]);

        // 3. Create a Doctor User & matching Doctor record
        // Since our RBAC logic assumes User ID == Doctor ID for simplicity:
        $doctorUser = User::factory()->create([
            'name' => 'Dr. John Doe',
            'email' => 'doctor@example.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);

        Doctor::factory()->create([
            'id' => $doctorUser->id,
            'name' => $doctorUser->name,
            'specialization' => 'General Practice',
        ]);

        // 4. Create some additional fake doctors
        Doctor::factory(4)->create();

        // 5. Create some fake patients assigned randomly to doctors
        Patient::factory(25)->create();
    }
}
