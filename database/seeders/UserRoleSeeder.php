<?php

namespace Database\Seeders;

use App\Models\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserRole::create([
            'role_name' => 'Admin',
            'role_detail' => 'An Admin',
        ]);

        UserRole::create([
            'role_name' => 'Super Admin',
            'role_detail' => 'A Super Admin',
        ]);
    }
}
