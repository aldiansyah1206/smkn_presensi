<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kegiatan')->insert([
            ['name' => 'Bola Kaki'],
            ['name' => 'Bola Voly'],
            ['name' => 'Bola Basket'],
            ['name' => 'Tari'],
            ['name' => 'Musik'],
            ['name' => 'Vokal'],
            ['name' => 'Drumband'],
            ['name' => 'Pramuka'],
        ]);
    }
}
