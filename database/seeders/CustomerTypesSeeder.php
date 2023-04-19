<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_types')->insert([
            [
                'type' => 'Comida',
                'isLeader' => 1
            ],
            [
                'type' => 'Multiservices',
                'isLeader' => 1
            ],
            [
                'type' => 'Construcción',
                'isLeader' => 1
            ],
            [
                'type' => 'Servicios de Limpieza',
                'isLeader' => 1
            ],
            [
                'type' => 'Jardinería',
                'isLeader' => 1
            ],
            [
                'type' => 'Automovil',
                'isLeader' => 0
            ],
            [
                'type' => 'Electronicos',
                'isLeader' => 0
            ],
            [
                'type' => 'Educacion',
                'isLeader' => 0
            ],
            [
                'type' => 'Entretenimiento',
                'isLeader' => 0
            ],
            [
                'type' => 'Salud',
                'isLeader' => 0
            ],
            [
                'type' => 'Mascotas',
                'isLeader' => 0
            ],
            [
                'type' => 'Legal',
                'isLeader' => 0
            ],
            [
                'type' => 'Finanzas',
                'isLeader' => 0
            ],
            [
                'type' => 'Fabricas',
                'isLeader' => 0
            ],
            [
                'type' => 'Tiendas',
                'isLeader' => 0
            ],
            [
                'type' => 'Cuidado Personal',
                'isLeader' => 0
            ],
            [
                'type' => 'Bienes Raices',
                'isLeader' => 0
            ],
            [
                'type' => 'Deportes',
                'isLeader' => 0
            ],
            [
                'type' => 'Aseguranzas',
                'isLeader' => 0
            ],
            [
                'type' => 'Transporte',
                'isLeader' => 0
            ],
            [
                'type' => 'Iglesias',
                'isLeader' => 0
            ],
            [
                'type' => 'Personalizados',
                'isLeader' => 0
            ],
        ]);
    }
}
