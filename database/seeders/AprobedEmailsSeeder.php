<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AprobedEmailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aprobedemails')->insert([
            [
                'customer' => 'Email de prueba. Ignorar',
                'customer_id' => 0,
                'user_id' => '15',
                'urldropbox' => 'https://www.dropbox.com/home',
                'aprobed' => 1,
                'approver' => 'Martin murillo',
                'message' => ''
            ],
            [
                'customer' => 'Clover Lanscaping',
                'customer_id' => 0,
                'user_id' => '14',
                'urldropbox' => 'https://www.dropbox.com/s/qbrg8avefhz4kd9/SIGN%20TRAILA_3x4.jpg?dl=0',
                'aprobed' => 1,
                'approver' => 'Jose Murillo',
                'message' => ''
            ],
            [
                'customer' => 'El Aguaje Mexican Grill',
                'customer_id' => 0,
                'user_id' => '14',
                'urldropbox' => 'https://drive.google.com/file/d/1smMNXFo1SLSyTxvr5diAeCLf3aNWYE4Y/view?usp=sharing',
                'aprobed' => 1,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'Mexi Wing',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/1Az4w35BvSGgu0d62bkjad_Ypc08PJSTk/view?usp=sharing',
                'aprobed' => 1,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'Mexi Wing',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/1Az4w35BvSGgu0d62bkjad_Ypc08PJSTk/view?usp=sharing',
                'aprobed' => 1,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'Mexi Wing Test',
                'customer_id' => 0,
                'user_id' => '14',
                'urldropbox' => 'https://drive.google.com/file/d/1smMNXFo1SLSyTxvr5diAeCLf3aNWYE4Y/view?usp=sharing',
                'aprobed' => 1,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'La Esperanza (KY)',
                'customer_id' => 0,
                'user_id' => '4',
                'urldropbox' => 'https://drive.google.com/file/d/1ZVgzWvvoBakYdV3HaJoQEM6D4Su4ZvMl/view?usp=sharing',
                'aprobed' => 0,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'Burrito Wings',
                'customer_id' => 0,
                'user_id' => '4',
                'urldropbox' => 'https://drive.google.com/file/d/1eH3BH5h4DY0_exR3wNFdOVjprZnf7Pd4/view?usp=sharing',
                'aprobed' => 0,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'El Rey Azteca',
                'customer_id' => 0,
                'user_id' => '4',
                'urldropbox' => 'https://drive.google.com/file/d/1V4ffdOkSsGWBm8TIVy2pnctk8y3_Yg53/view?usp=sharing',
                'aprobed' => 1,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'Antojitos y Mariscos Los Jarochos',
                'customer_id' => 0,
                'user_id' => '12',
                'urldropbox' => 'https://drive.google.com/file/d/1yt_jD3z_Nmu9POVJCGBSGXxA_S7W2I91/view?usp=sharing',
                'aprobed' => 0,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'Amparo\'s Kitchen',
                'customer_id' => 0,
                'user_id' => '4',
                'urldropbox' => 'https://drive.google.com/file/d/1Gba4bT0Q-Ls-vZIG_SCb5LWv_Ay1K_B-/view?usp=sharing',
                'aprobed' => 1,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'Tlaquepaque',
                'customer_id' => 0,
                'user_id' => '4',
                'urldropbox' => 'https://drive.google.com/file/d/17Jp1MWY7ZOCGx5FFXhOGCTcqy3JhH5a3/view?usp=sharing',
                'aprobed' => 1,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'JALISCO TAQUERÍA',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/12H895TpsVLR2G7lbBujMxyqfAuNiaMyQ/view?usp=sharing',
                'aprobed' => 0,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'LA ESPERANZA KY - to go',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/1_xv-ClDMajZdYUPeCfPVYSLS-DPmcY8S/view?usp=sharing',
                'aprobed' => 0,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'MEXI WING - Portadas',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/1zGH67FSb8SKnEDGcfXGzRfLpcYliGiIk/view?usp=sharing',
                'aprobed' => 1,
                'approver' => 'Tanya Sanchez',
                'message' => ''
            ],
            [
                'customer' => 'EL SUEÑO - To go',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/1tynvlWaehRojJa4NrVGZ3NDdA2PZC0O2/view?usp=sharing',
                'aprobed' => 1,
                'approver' => 'Rafael arenas',
                'message' => ''
            ],
            [
                'customer' => 'LOS CHARROS B/N- to go',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/1D4WokerO2DgMWxUm6aDGGVRLdtMQQP4-/view?usp=sharing',
                'aprobed' => 1,
                'approver' => 'Francisco angulo',
                'message' => ''
            ],
            [
                'customer' => 'LOS CHARROS',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/1Q5iHCCUTh1Fii1ZXkd04sfq4MZTvlZ2a/view?usp=sharing',
                'aprobed' => 0,
                'approver' => '',
                'message' => ''
            ],
            [
                'customer' => 'Los Zacatecanos  to go',
                'customer_id' => 0,
                'user_id' => '16',
                'urldropbox' => 'https://drive.google.com/file/d/1BNM-ubJajUyohS367XwRu2-0IpvN9l0R/view?usp=sharing',
                'aprobed' => 1,
                'approver' => 'Daisy Rodriguez',
                'message' => ''
            ],
            [
                'customer' => 'EL SUEÑO 2',
                'customer_id' => 0,
                'user_id' => '5',
                'urldropbox' => 'https://drive.google.com/file/d/10mh-X_vBGwKkHmXj8t155cnwiJCc6MVO/view?usp=sharing',
                'aprobed' => 1,
                'approver' => 'Elena Ortiz',
                'message' => ''
            ],
        ]);
    }
}
