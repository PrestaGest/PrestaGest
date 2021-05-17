<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                // 'avatar' => null,
                'email' => 'admin@admin.com',
                // 'is_admin' => true,
                'name' => 'System Admin',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
                'permissions' => '{"platform.systems.roles":true,"platform.systems.users":true,"platform.systems.attachment":true,"platform.index":true}',
                // 'roles' => null,
                // 'group' => null,
            ],
            // [
            //     'avatar' => null,
            //     'email' => 'employee@ibooking.ml',
            //     'is_admin' => false,
            //     'name' => 'employee',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            //     'roles' => json_encode(["App\\Filament\\Roles\\Employee"]),
            //     'group' => 1,
            // ],
            // [
            //     'avatar' => null,
            //     'email' => 'employee2@ibooking.ml',
            //     'is_admin' => false,
            //     'name' => 'employee2',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            //     'roles' => json_encode(["App\\Filament\\Roles\\Employee"]),
            //     'group' => 2,
            // ],
            // [
            //     'avatar' => null,
            //     'email' => 'manager@ibooking.ml',
            //     'is_admin' => false,
            //     'name' => 'Manager',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            //     'roles' => json_encode(["App\\Filament\\Roles\\Manager"]),
            //     'group' => 1,
            // ],
            // [
            //     'avatar' => null,
            //     'email' => 'manager2@ibooking.ml',
            //     'is_admin' => false,
            //     'name' => 'Manager2',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            //     'roles' => json_encode(["App\\Filament\\Roles\\Manager"]),
            //     'group' => 2,
            // ],
            // [
            //     'avatar' => null,
            //     'email' => 'director@ibooking.ml',
            //     'is_admin' => false,
            //     'name' => 'Director',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            //     'roles' => json_encode(["App\\Filament\\Roles\\Director"]),
            //     'group' => 1,
            // ],
            // [
            //     'avatar' => null,
            //     'email' => 'director2@ibooking.ml',
            //     'is_admin' => false,
            //     'name' => 'Director2',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            //     'roles' => json_encode(["App\\Filament\\Roles\\Director"]),
            //     'group' => 2,
            // ],
            // [
            //     'avatar' => null,
            //     'email' => 'guest@ibooking.ml',
            //     'is_admin' => false,
            //     'name' => 'Guest',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            //     'roles' => json_encode(["App\\Filament\\Roles\\Guest"]),
            //     'group' => 1,
            // ],
            // [
            //     'avatar' => null,
            //     'email' => 'guest2@ibooking.ml',
            //     'is_admin' => false,
            //     'name' => 'Guest2',
            //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            //     'remember_token' => Str::random(10),
            //     'roles' => json_encode(["App\\Filament\\Roles\\Guest"]),
            //     'group' => 2,
            // ],

        ];

        DB::table('users')->insert($users);
    }
}
