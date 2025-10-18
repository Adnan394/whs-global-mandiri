<?php

namespace Database\Seeders;

use App\Models\EmploymentType;
use App\Models\ExperienceLevel;
use App\Models\User;
use App\Models\Rank;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crewing'
        ]);

        Rank::create([
            'name' => 'Crewing Staff',
            'type' => 2
        ]);
        Rank::create([
            'name' => 'Crewing Superintendent',
            'type' => 2
        ]);
        Rank::create([
            'name' => 'HRD',
            'type' => 2
        ]);
        Rank::create([
            'name' => 'Master',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Chief Officer',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Second Officer',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Third Officer',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Able Seaman (AB)',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Able Seaman (AB)',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Chief Engineer',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Second Engineer',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Third Engineer',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Oiler',
            'type' => 1
        ]);
        Rank::create([
            'name' => 'Cook',
            'type' => 1
        ]);

        ExperienceLevel::create([
            'name' => 'Fresh Graduate',
        ]);
        ExperienceLevel::create([
            'name' => 'Junior',
        ]);
        ExperienceLevel::create([
            'name' => 'Middle',
        ]);
        ExperienceLevel::create([
            'name' => 'Senior',
        ]);
        ExperienceLevel::create([
            'name' => 'Supervisor',
        ]);
        ExperienceLevel::create([
            'name' => 'Manager',
        ]);

        EmploymentType::create([
            'name' => 'Full Time',
        ]);
        EmploymentType::create([
            'name' => 'Part Time',
        ]);
        EmploymentType::create([
            'name' => 'Contract',
        ]);
        EmploymentType::create([
            'name' => 'Internship',
        ]);
    }
}