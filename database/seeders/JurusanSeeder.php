<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusan')->insert([
            ['name' => 'AK 1'],
            ['name' => 'ATP 1'],
            ['name' => 'TKJ 1'],
            ['name' => 'TBSM 1'],
            ['name' => 'AK 2'],
            ['name' => 'ATP 2'],
            ['name' => 'TKJ 2'],
            ['name' => 'TBSM 2'],
        ]);
    }
}
