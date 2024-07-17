<?php

namespace Database\Seeders;

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
        Role::create([
            'name' =>'admin',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' =>'pembina',
            'guard_name' => 'web'
        ]);

        Role::create([
            'name' =>'siswa',
            'guard_name' => 'web'
        ]);
    }
}
