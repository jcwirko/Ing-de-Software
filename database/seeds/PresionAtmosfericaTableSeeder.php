<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PresionAtmosfericaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('presion_atmosferica')->insert([
            'presion' => floatval(rand(1000,1015) . '.' . rand(1,9)),
            'fecha' => \Illuminate\Support\Carbon::now(),
            'label_chart' =>  \Illuminate\Support\Carbon::now(),
        ]);
    }
}
