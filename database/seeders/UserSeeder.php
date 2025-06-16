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
        $roles = [
            'produksi',
            'qc',
            'analis',
            'manager qc',
            'marketing',
            'superadmin',
        ];

        foreach ($roles as $role) {
            User::create([
                'name' => ucfirst($role),
                'email' => $role . '@example.com',
                'password' => Hash::make('Test123!'), // default password
                'role' => $role,
            ]);
        }
    }
}
