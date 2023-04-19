<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                 'name' => 'Roberto',
                 'lastname' => 'Venegas',
                 'email' => 'rv@bliones.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 1,
                 'remember_token' => NULL,
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1H9IxVWwraQWcObAqoD3MY2vHXlf98ZV5',
                 'departament_alt_id' => 4
            ],
            [
                 'name' => 'Selene',
                 'lastname' => 'Sanchez',
                 'email' => 'sales@bliones.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 4,
                 'remember_token' => NULL,
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1APRasJ9qEA9UTyH_QrpdG0E5dhhcy-Hy',
                 'departament_alt_id' => 0
            ],
            [
                 'name' => 'Vania',
                 'lastname' => 'Ramos',
                 'email' => 'vania.bliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 4,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1G4KstRReyhn5nG5LLL3CuibkTrJBC1Hx',
                 'departament_alt_id' => 8
            ],
            [
                 'name' => 'Brenda',
                 'lastname' => 'Ayala',
                 'email' => 'design@bliones.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 6,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1THj5Xat5Sttc5r_6cXZglw6uPGjOwAH5',
                 'departament_alt_id' => 0
            ],
            [
                 'name' => 'Denys',
                 'lastname' => 'Vera',
                 'email' => 'denys.bliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 6,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1eOE8ZAy-h8-JaETPZq8Ea8iyXCaHxDWZ',
                 'departament_alt_id' => 0
            ],
            [
                 'name' => 'Irma',
                 'lastname' => 'Velazquez',
                 'email' => 'accounting@bliones.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 1,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1Ye0LOFZt-9rTdr_QYnQI8iYlMM9HLaRO',
                 'departament_alt_id' => 4
            ],
            [
                 'name' => 'Maribel',
                 'lastname' => 'Hernández',
                 'email' => 'mary.bliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 4,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1lf39hfflWLE9b_krKK5GF1m-xpRqYeX6',
                 'departament_alt_id' => 0
            ],
            [
                 'name' => 'Alejandra',
                 'lastname' => 'Cuestas',
                 'email' => 'alebliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 5,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1pBVmHrDGKhXByaCJzViWUFZNP6-xaBdj',
                 'departament_alt_id' => 0
            ],
            [
                 'name' => 'Carolina',
                 'lastname' => 'Yocupicio',
                 'email' => 'cybliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 3,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1-zwbH9HCFCzErlKiuZU4ftMxHIXZs5o5',
                 'departament_alt_id' => NULL
            ],
            [
                 'name' => 'Daniel',
                 'lastname' => 'Garcia',
                 'email' => 'dbliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 2,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1Cm0IpkBH2eKn9VGlywdxIl2HKXsgsC02',
                 'departament_alt_id' => 8
            ],
            [
                 'name' => 'Netzahualcoyotl',
                 'lastname' => 'Jimenez',
                 'email' => 'netzabliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 2,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1m6HSpzDKEC01-dft8sjNlXnVMUWmzvoX',
                 'departament_alt_id' => 6
            ],
            [
                 'name' => 'Alma',
                 'lastname' => 'Diaz',
                 'email' => 'alma.bliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 6,
                 'remember_token' => 'null',
                 'token' => '',
                 'avatar' => 'https://drive.google.com/uc?id=1O4_9S_VxYfxCRAwdGWqLXkCM7WTqUFoq',
                 'departament_alt_id' => 0
            ],
            [
                 'name' => 'Landa',
                 'lastname' => 'Landa',
                 'email' => 'landa.bliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 4,
                 'remember_token' => NULL,
                 'token' => '',
                 'avatar' => '',
                 'departament_alt_id' => 0
            ],
            [
                 'name' => 'Natalia',
                 'lastname' => 'Verastegui',
                 'email' => 'natbliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 8,
                 'remember_token' => NULL,
                 'token' => 'vkmeix238qip21pau5pgs7',
                 'avatar' => NULL,
                 'departament_alt_id' => NULL
            ],
            [
                 'name' => 'Manuel',
                 'lastname' => 'Lopez',
                 'email' => 'manuelbliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 3,
                 'remember_token' => NULL,
                 'token' => '67lucp7dmd6c5as61wagrn',
                 'avatar' => NULL,
                 'departament_alt_id' => 6
            ],
            [
                 'name' => 'Nancy',
                 'lastname' => 'Quiñones',
                 'email' => 'nancybliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 4,
                 'remember_token' => NULL,
                 'token' => 'p4v7r8e814mqujgwzcjft',
                 'avatar' => NULL,
                 'departament_alt_id' => NULL
            ],
            [
                 'name' => 'Deborah',
                 'lastname' => 'Arizabalo',
                 'email' => 'debbliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 8,
                 'remember_token' => NULL,
                 'token' => 'rllxajcvqvld89yilzr',
                 'avatar' => NULL,
                 'departament_alt_id' => 6
            ],
            [
                 'name' => 'Khelly',
                 'lastname' => 'Chavez',
                 'email' => 'kellybliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 8,
                 'remember_token' => NULL,
                 'token' => 'gxsl1v9w6cqspf27jo8s4',
                 'avatar' => NULL,
                 'departament_alt_id' => NULL
            ],
            [
                 'name' => 'Armando',
                 'lastname' => 'Marta',
                 'email' => 'armandobliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 4,
                 'remember_token' => NULL,
                 'token' => 'oqjncvnccjokvgyu9atqfn',
                 'avatar' => NULL,
                 'departament_alt_id' => NULL
            ],
            [
                 'name' => 'Pamela',
                 'lastname' => 'Diaz',
                 'email' => 'pamelabliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 1,
                 'departament_id' => 1,
                 'remember_token' => NULL,
                 'token' => 'afualt56qdidcv1c9frzfb',
                 'avatar' => NULL,
                 'departament_alt_id' => NULL
            ],
            [
                 'name' => 'Estefany',
                 'lastname' => 'N',
                 'email' => 'estefbliones@gmail.com',
                 'personal_phone' => '+529841533143',
                 'public_phone' => '+529841533143',
                 'password' => Hash::make('test'),
                 'role_id' => 2,
                 'departament_id' => 4,
                 'remember_token' => NULL,
                 'token' => 'e28jdykx8b54z3lzl6ha0e',
                 'avatar' => NULL,
                 'departament_alt_id' => NULL
            ],
        ]);
    }
}
