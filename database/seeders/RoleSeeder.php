<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat role admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'pembina']);
        Role::firstOrCreate(['name' => 'siswa']);

        // Tambahkan peran admin kepada pengguna dengan ID 1
        $adminUser = User::find(1);
        if ($adminUser) {
            $adminUser->assignRole($adminRole);
        }
    }
}
