<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeridoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        /*DB::table('periodo')->insert([
            'periodo' => 'Enero-Junio',
            'year' => '2020'
        ],[
            'periodo' => 'Agosto-Diciembre',
            'year' => '2020'
        ],[
            'periodo' => 'Verano',
            'year' => '2020'
        ],[
            'periodo' => 'Enero-Junio',
            'year' => '2021'
        ]);*/


        DB::table('periodo')->insert([
            'periodo' => 'Enero-Junio',
            'year' => '2021'
        ]);

        DB::table('periodo')->insert([
            'periodo' => 'Agosto-Diciembre',
            'year' => '2021'
        ]);
    }
}
