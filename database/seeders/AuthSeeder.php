<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AuthSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        $roles = ['super_admin', 'admin', 'driver'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // Super admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@fleet.test'],
            [
                'name'         => 'Super Admin',
                'phone_number' => '081200000001',
                'password'     => Hash::make('password'),
            ]
        );
        $superAdmin->syncRoles(['super_admin']);

        // Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@fleet.test'],
            [
                'name'         => 'Admin',
                'phone_number' => '081200000002',
                'password'     => Hash::make('password'),
            ]
        );
        $admin->syncRoles(['admin']);

        // Drivers
        $drivers = [
            [
                'user' => [
                    'name'         => 'Budi Santoso',
                    'email'        => 'budi@fleet.test',
                    'phone_number' => '081200000003',
                    'password'     => Hash::make('password'),
                ],
                'driver' => [
                    'employee_id'    => 'DRV-001',
                    'license_number' => 'SIM-A-001',
                    'license_expiry' => '2027-12-31',
                    'status'         => 'active',
                ],
            ],
            [
                'user' => [
                    'name'         => 'Siti Rahayu',
                    'email'        => 'siti@fleet.test',
                    'phone_number' => '081200000004',
                    'password'     => Hash::make('password'),
                ],
                'driver' => [
                    'employee_id'    => 'DRV-002',
                    'license_number' => 'SIM-A-002',
                    'license_expiry' => '2026-06-30',
                    'status'         => 'active',
                ],
            ],
        ];

        foreach ($drivers as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['user']['email']],
                $data['user']
            );
            $user->syncRoles(['driver']);

            Driver::firstOrCreate(
                ['user_id' => $user->id],
                array_merge($data['driver'], ['user_id' => $user->id])
            );
        }
    }
}
