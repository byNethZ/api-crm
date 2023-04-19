<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'category' => 'Uniformes',
                'img_url' => 'https://bliones.net/assets/departaments/02-uniformes.jpg'
            ],
            [
                'category' => 'Menus',
                'img_url' => 'https://bliones.net/assets/departaments/01-menus.jpg'
            ],
            [
                'category' => 'Anuncios',
                'img_url' => 'https://bliones.net/assets/departaments/06-Anuncios.jpg'
            ],
            [
                'category' => 'Car Graphics',
                'img_url' => 'https://bliones.net/assets/departaments/08-Car-Graphic.jpg'
            ],
            [
                'category' => 'Impresos',
                'img_url' => 'https://bliones.net/assets/departaments/03-Impresos.jpg'
            ],
            [
                'category' => 'Decorativos',
                'img_url' => 'https://bliones.net/assets/departaments/05-decorativos.jpg'
            ],
            [
                'category' => 'Servicios Digitales',
                'img_url' => 'https://bliones.net/assets/departaments/04-digital.jpg'
            ],
            [
                'category' => 'Promos',
                'img_url' => 'https://bliones.net/assets/departaments/07-promocionales.jpg'
            ],
        ]);
    }
}
