<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->insert([
            [
                'country_id' => 142,
                'state_name' => 'Aguascalientes',
                'state_code' => 'MX-AGU',
                'lat' => '22.000100',
                'lng' => '-102.500000'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Baja California',
                'state_code' => 'MX-BCN',
                'lat' => '30.033892',
                'lng' => '-115.142511'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Baja California Sur',
                'state_code' => 'MX-BCS',
                'lat' => '25.581801',
                'lng' => '-111.570616'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Campeche',
                'state_code' => 'MX-CAM',
                'lat' => '19.843867',
                'lng' => '-90.525545'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Chiapas',
                'state_code' => 'MX-CHP',
                'lat' => '16.500000',
                'lng' => '-92.500000'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Chihuahua',
                'state_code' => 'MX-CHH',
                'lat' => '28.500000',
                'lng' => '-106.000000'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Ciudad de Mexico',
                'state_code' => 'MX-CMX',
                'lat' => '19.428470',
                'lng' => '-99.127660'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Coahuila de Zaragoza',
                'state_code' => 'MX-COA',
                'lat' => '27.333331',
                'lng' => '-102.000000'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Colima',
                'state_code' => 'MX-COL',
                'lat' => '19.166667',
                'lng' => '-104.000000'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Durango',
                'state_code' => 'MX-DUR',
                'lat' => '24.833333',
                'lng' => '-104.833333'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Guanajuato',
                'state_code' => 'MX-GUA',
                'lat' => '20.987699',
                'lng' => '-100.999999'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Guerrero',
                'state_code' => 'MX-GRO',
                'lat' => '18.020529',
                'lng' => '-99.662476'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Hidalgo',
                'state_code' => 'MX-HID',
                'lat' => '20.500000',
                'lng' => '-98.999999'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Jalisco',
                'state_code' => 'MX-JAL',
                'lat' => '20.333333',
                'lng' => '-103.666660'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Mexico',
                'state_code' => 'MX-MEX',
                'lat' => '19.483945',
                'lng' => '-99.689971'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Michoacan de Ocampo',
                'state_code' => 'MX-MIC',
                'lat' => '19.207098',
                'lng' => '-101.878113'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Morelos',
                'state_code' => 'MX-MOR',
                'lat' => '18.681305',
                'lng' => '-99.101349'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Nayarit',
                'state_code' => 'MX-NAY',
                'lat' => '16.341390',
                'lng' => '-93.389170'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Nuevo Leon',
                'state_code' => 'MX-NLE',
                'lat' => '26.238436',
                'lng' => '-99.887299'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Oaxaca',
                'state_code' => 'MX-OAX',
                'lat' => '17.000000',
                'lng' => '-96.499999'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Puebla',
                'state_code' => 'MX-PUE',
                'lat' => '18.833333',
                'lng' => '-98.000000'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Queretaro',
                'state_code' => 'MX-QUE',
                'lat' => '20.854257',
                'lng' => '-99.847560'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Quintana Roo',
                'state_code' => 'MX-ROO',
                'lat' => '19.263021',
                'lng' => '-87.450912'
            ],
            [
                'country_id' => 142,
                'state_name' => 'San Luis Potosi',
                'state_code' => 'MX-SLP',
                'lat' => '22.500000',
                'lng' => '-100.494915'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Sinaloa',
                'state_code' => 'MX-SIN',
                'lat' => '25.000000',
                'lng' => '-107.500000'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Sonora',
                'state_code' => 'MX-SON',
                'lat' => '29.333333',
                'lng' => '-110.666667'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Tabasco',
                'state_code' => 'MX-TAB',
                'lat' => '17.989291',
                'lng' => '-92.928116'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Tamaulipas',
                'state_code' => 'MX-TAM',
                'lat' => '23.989155',
                'lng' => '-98.702682'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Tlaxcala',
                'state_code' => 'MX-TLA',
                'lat' => '19.416667',
                'lng' => '-98.166667'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Veracruz de Ignacio de la Llave',
                'state_code' => 'MX-VER',
                'lat' => '19.333333',
                'lng' => '-96.666669'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Yucatan',
                'state_code' => 'MX-YUC',
                'lat' => '20.400417',
                'lng' => '-89.134857'
            ],
            [
                'country_id' => 142,
                'state_name' => 'Zacatecas',
                'state_code' => 'MX-ZAC',
                'lat' => '22.768643',
                'lng' => '-102.581412'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Alabama',
                'state_code' => 'US-AL',
                'lat' => '32.318230',
                'lng' => '-86.902298'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Alaska',
                'state_code' => 'US-AK',
                'lat' => '66.160507',
                'lng' => '-153.369141'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Arizona',
                'state_code' => 'US-AZ',
                'lat' => '34.048927',
                'lng' => '-111.093735'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Arkansas',
                'state_code' => 'US-AR',
                'lat' => '34.799999',
                'lng' => '-92.199997'
            ],
            [
                'country_id' => 236,
                'state_name' => 'California',
                'state_code' => 'US-CA',
                'lat' => '36.778259',
                'lng' => '-119.417931'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Colorado',
                'state_code' => 'US-CO',
                'lat' => '39.113014',
                'lng' => '-105.358887'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Connecticut',
                'state_code' => 'US-CT',
                'lat' => '41.599998',
                'lng' => '-72.699997'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Delaware',
                'state_code' => 'US-DE',
                'lat' => '39.000000',
                'lng' => '-75.500000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'District of Columbia',
                'state_code' => 'US-DC',
                'lat' => '38.942143',
                'lng' => '-77.025955'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Florida',
                'state_code' => 'US-FL',
                'lat' => '27.994402',
                'lng' => '-81.760254'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Georgia',
                'state_code' => 'US-GA',
                'lat' => '33.247875',
                'lng' => '-83.441162'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Hawaii',
                'state_code' => 'US-HI',
                'lat' => '19.741755',
                'lng' => '-155.844437'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Idaho',
                'state_code' => 'US-ID',
                'lat' => '44.068203',
                'lng' => '-114.742043'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Illinois',
                'state_code' => 'US-IL',
                'lat' => '40.000000',
                'lng' => '-89.000000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Indiana',
                'state_code' => 'US-IN',
                'lat' => '40.273502',
                'lng' => '-86.126976'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Iowa',
                'state_code' => 'US-IA',
                'lat' => '42.032974',
                'lng' => '-93.581543'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Kansas',
                'state_code' => 'US-KS',
                'lat' => '38.500000',
                'lng' => '-98.000000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Kentucky',
                'state_code' => 'US-KY',
                'lat' => '37.839333',
                'lng' => '-84.270020'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Louisiana',
                'state_code' => 'US-LA',
                'lat' => '30.391830',
                'lng' => '-92.329102'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Maine',
                'state_code' => 'US-ME',
                'lat' => '45.367584',
                'lng' => '-68.972168'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Maryland',
                'state_code' => 'US-MD',
                'lat' => '39.045753',
                'lng' => '-76.641273'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Massachusetts',
                'state_code' => 'US-MA',
                'lat' => '42.407211',
                'lng' => '-71.382439'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Michigan',
                'state_code' => 'US-MI',
                'lat' => '44.182205',
                'lng' => '-84.506836'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Minnesota',
                'state_code' => 'US-MN',
                'lat' => '46.392410',
                'lng' => '-94.636230'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Mississippi',
                'state_code' => 'US-MS',
                'lat' => '33.000000',
                'lng' => '-90.000000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Missouri',
                'state_code' => 'US-MO',
                'lat' => '38.573936',
                'lng' => '-92.603760'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Montana',
                'state_code' => 'US-MT',
                'lat' => '46.965260',
                'lng' => '-109.533691'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Nebraska',
                'state_code' => 'US-NE',
                'lat' => '41.500000',
                'lng' => '-100.000000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Nevada',
                'state_code' => 'US-NV',
                'lat' => '39.876019',
                'lng' => '-117.224121'
            ],
            [
                'country_id' => 236,
                'state_name' => 'New Hampshire',
                'state_code' => 'US-NH',
                'lat' => '44.000000',
                'lng' => '-71.500000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'New Jersey',
                'state_code' => 'US-NJ',
                'lat' => '39.833851',
                'lng' => '-74.871826'
            ],
            [
                'country_id' => 236,
                'state_name' => 'New Mexico',
                'state_code' => 'US-NM',
                'lat' => '34.307144',
                'lng' => '-106.018066'
            ],
            [
                'country_id' => 236,
                'state_name' => 'New York',
                'state_code' => 'US-NY',
                'lat' => '43.000000',
                'lng' => '-75.000000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'North Carolina',
                'state_code' => 'US-NC',
                'lat' => '35.782169',
                'lng' => '-80.793457'
            ],
            [
                'country_id' => 236,
                'state_name' => 'North Dakota',
                'state_code' => 'US-ND',
                'lat' => '47.650589',
                'lng' => '-100.437012'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Ohio',
                'state_code' => 'US-OH',
                'lat' => '40.367474',
                'lng' => '-82.996216'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Oklahoma',
                'state_code' => 'US-OK',
                'lat' => '36.084621',
                'lng' => '-96.921387'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Oregon',
                'state_code' => 'US-OR',
                'lat' => '44.000000',
                'lng' => '-120.500000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Pennsylvania',
                'state_code' => 'US-PA',
                'lat' => '41.203323',
                'lng' => '-77.194527'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Rhode Island',
                'state_code' => 'US-RI',
                'lat' => '41.742325',
                'lng' => '-71.742332'
            ],
            [
                'country_id' => 236,
                'state_name' => 'South Carolina',
                'state_code' => 'US-SC',
                'lat' => '33.836082',
                'lng' => '-81.163727'
            ],
            [
                'country_id' => 236,
                'state_name' => 'South Dakota',
                'state_code' => 'US-SD',
                'lat' => '44.500000',
                'lng' => '-100.000000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Tennessee',
                'state_code' => 'US-TN',
                'lat' => '35.860119',
                'lng' => '-86.660156'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Texas',
                'state_code' => 'US-TX',
                'lat' => '31.000000',
                'lng' => '-100.000000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Utah',
                'state_code' => 'US-UT',
                'lat' => '39.419220',
                'lng' => '-111.950684'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Vermont',
                'state_code' => 'US-VT',
                'lat' => '44.000000',
                'lng' => '-72.699997'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Virginia',
                'state_code' => 'US-VA',
                'lat' => '37.926868',
                'lng' => '-78.024902'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Washington',
                'state_code' => 'US-WA',
                'lat' => '47.751076',
                'lng' => '-120.740135'
            ],
            [
                'country_id' => 236,
                'state_name' => 'West Virginia',
                'state_code' => 'US-WV',
                'lat' => '39.000000',
                'lng' => '-80.500000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Wisconsin',
                'state_code' => 'US-WI',
                'lat' => '44.500000',
                'lng' => '-89.500000'
            ],
            [
                'country_id' => 236,
                'state_name' => 'Wyoming',
                'state_code' => 'US-WY',
                'lat' => '43.075970',
                'lng' => '-107.290283'
            ],
        ]);
    }
}
