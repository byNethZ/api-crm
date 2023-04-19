<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            AprobedEmailsSeeder::class,
            CataloguesSeeder::class,
            CustomerSeeder::class,
            CustomerTypesSeeder::class,
            DepartamentsSeeder::class,
            GoalsSeeder::class,
            ProductCategoriesSeeder::class,
            ProductsSeeder::class,
            RolesSeeder::class,
            StatesSeeder::class,
            UsersSeeder::class,
            WebsitesSeeder::class,
        ]);
    }
}
