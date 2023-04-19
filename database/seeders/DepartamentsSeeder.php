<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departaments')->insert([
            [
                'name' => 'Operaciones',
                'leader_id' => 1,
                'public' => NULL
            ],
            [
                'name' => 'Digital',
                'leader_id' => 14,
                'public' => 1
            ],
            [
                'name' => 'Impresos',
                'leader_id' => 12,
                'public' => 1
            ],
            [
                'name' => 'Ventas',
                'leader_id' => 2,
                'public' => NULL
            ],
            [
                'name' => 'Uniformes',
                'leader_id' => 11,
                'public' => 1
            ],
            [
                'name' => 'Menus',
                'leader_id' => 4,
                'public' => 1
            ],
            [
                'name' => 'Decorativos',
                'leader_id' => 4,
                'public' => 1
            ],
            [
                'name' => 'Marketing',
                'leader_id' => 14,
                'public' => NULL
            ],
        ]);
    }
}
