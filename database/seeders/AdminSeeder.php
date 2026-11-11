<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'staimas.admin.ikamas@staimas.ac.id'],
            [
                'name' => 'Administrator IKAMAS',
                'password' => Hash::make('St4!m4s@Adm!n#2026$IK4M4S'),
            ]
        );
    }
}
