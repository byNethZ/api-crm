<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CataloguesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('catalogues')->insert([
            [
                'name' => 'Catalogo Menús 2022',
                'url' => 'https://www.catalogos.bliones.com/menus/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/menus.png',
            ],
            [
                'name' => 'Catalogo Uniformes 2022',
                'url' => 'https://www.catalogos.bliones.com/uniformes/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/uniformes.png',
            ],
            [
                'name' => 'Catalogo Impresos 2022',
                'url' => 'https://www.catalogos.bliones.com/impresos/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/impresos.jpg',
            ],
            [
                'name' => 'Catalogo Signs 2022',
                'url' => 'https://www.catalogos.bliones.com/signs/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/signs.png',
            ],
            [
                'name' => 'Catalogo Promocionales 2022',
                'url' => 'https://www.catalogos.bliones.com/promocionales/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/promos.png',
            ],
            [
                'name' => 'Catalogo Car Graphics 2022',
                'url' => 'https://www.catalogos.bliones.com/cargraphics/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/cargra.png',
            ],
            [
                'name' => 'Catalogo Muebles 2022',
                'url' => 'https://www.catalogos.bliones.com/muebles/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/muebles.png',
            ],
            [
                'name' => 'Catalogo Digital 2022',
                'url' => 'https://www.catalogos.bliones.com/digital/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/digital.png',
            ],
            [
                'name' => 'Bliones Photography',
                'url' => 'https://photo.bliones.com/portfolio/',
                'image' => 'https://catalogos.bliones.com/src/img/bliones-photography.png',
            ],
            [
                'name' => 'Catalogo Fotos para Restaurantes',
                'url' => 'https://www.catalogos.bliones.com/fotosrestaurantes/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/fotos-restaurantes.png',
            ],
            [
                'name' => 'Catalogo Canvas 2022',
                'url' => 'https://www.catalogos.bliones.com/canvas/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/canvas.png',
            ],
            [
                'name' => 'Chamarras',
                'url' => 'https://www.catalogos.bliones.com/chamarras/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/chamarras.png',
            ],
            [
                'name' => 'Logos (Ejemplos)',
                'url' => 'https://catalogos.bliones.com/logos/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/logos.jpg',
            ],
            [
                'name' => 'Websites Premium',
                'url' => 'https://www.catalogos.bliones.com/websites-premium/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/websitespremium.jpg',
            ],
            [
                'name' => 'Websites',
                'url' => 'https://www.catalogos.bliones.com/websites/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/websites.jpg',
            ],
            [
                'name' => 'Redes',
                'url' => 'https://www.catalogos.bliones.com/redes-sociales/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/redes.jpg',
            ],
            [
                'name' => 'Menus QR',
                'url' => 'https://menus.bliones.com/',
                'image' => 'https://catalogos.bliones.com/src/img/menusdigitales.jpg',
            ],
            [
                'name' => 'Menus Digitales',
                'url' => 'https://www.catalogos.bliones.com/digital-menus/?id=',
                'image' => 'https://catalogos.bliones.com/src/img/digital-menus.png',
            ],
        ]);
    }
}
