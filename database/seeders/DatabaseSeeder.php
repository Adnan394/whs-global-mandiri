<?php

namespace Database\Seeders;

use App\Models\EmploymentType;
use App\Models\ExperienceLevel;
use App\Models\User;
use App\Models\rank;
use App\Models\crew;
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
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crewing'
        ]);

        rank::create([
            'name' => 'Crewing Staff',
            'type' => 2
        ]);
        rank::create([
            'name' => 'Crewing Superintendent',
            'type' => 2
        ]);
        rank::create([
            'name' => 'HRD',
            'type' => 2
        ]);
        rank::create([
            'name' => 'Master',
            'type' => 1
        ]);
        rank::create([
            'name' => 'Chief Officer',
            'type' => 1
        ]);
        rank::create([
            'name' => 'Second Officer',
            'type' => 1
        ]);
        rank::create([
            'name' => 'Third Officer',
            'type' => 1
        ]);
        rank::create([
            'name' => 'Able Seaman (AB)',
            'type' => 1
        ]);
        rank::create([
            'name' => 'Chief Engineer',
            'type' => 1
        ]);
        rank::create([
            'name' => 'Second Engineer',
            'type' => 1
        ]);
        rank::create([
            'name' => 'Third Engineer',
            'type' => 1
        ]);
        rank::create([
            'name' => 'Oiler',
            'type' => 1
        ]);
        rank::create([
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

        User::create([
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crew'
        ]);

        User::create([
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crew'
        ]);

        User::create([
            'name' => 'User 3',
            'email' => 'user3@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crew'
        ]);

        User::create([
            'name' => 'User 4',
            'email' => 'user4@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crew'
        ]);

        User::create([
            'name' => 'User 5',
            'email' => 'user5@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crew'
        ]);

        User::create([
            'name' => 'User 6',
            'email' => 'user6@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crew'
        ]);

        User::create([
            'name' => 'User 7',
            'email' => 'user7@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crew'
        ]);

        User::create([
            'name' => 'User 8',
            'email' => 'user8@gmail.com',
            'password' => Hash::make('adnan394'),
            'role' => 'crew'
        ]);

        crew::create([
            'user_id' => 2,
            'fullname' => 'User 1',
            'nickname' => 'User 1',
            'phone' => '083156437871',
            'rank_id' => 1,
        ]);

        crew::create([
            'user_id' => 3,
            'fullname' => 'User 2',
            'nickname' => 'User 2',
            'phone' => '083156437871',
            'rank_id' => 1,
        ]);

        crew::create([
            'user_id' => 4,
            'fullname' => 'User 3',
            'nickname' => 'User 3',
            'phone' => '083156437871',
            'rank_id' => 2,
        ]);

        crew::create([
            'user_id' => 5,
            'fullname' => 'User 4',
            'nickname' => 'User 4',
            'phone' => '083156437871',
            'rank_id' => 2,
        ]);

        crew::create([
            'user_id' => 6,
            'fullname' => 'User 5',
            'nickname' => 'User 5',
            'phone' => '083156437871',
            'rank_id' => 3,
        ]);

        crew::create([
            'user_id' => 7,
            'fullname' => 'User 6',
            'nickname' => 'User 6',
            'phone' => '083156437871',
            'rank_id' => 3,
        ]);

        crew::create([
            'user_id' => 8,
            'fullname' => 'User 7',
            'nickname' => 'User 7',
            'phone' => '083156437871',
            'rank_id' => 4,
        ]);

        crew::create([
            'user_id' => 9,
            'fullname' => 'User 8',
            'nickname' => 'User 8',
            'phone' => '083156437871',
            'rank_id' => 4,
        ]);
    }
}