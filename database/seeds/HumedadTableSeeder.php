<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HumedadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $humedad = 25;

        // ULTIMOS 30 DIAS
        for ($dias = 30; $dias >= 0; $dias--) {
            // 50 HUMEDAD POR DIA
            for ($horas = 0; $horas <= 23; $horas++) {
                for ($min = 15; $min <= 60; $min += 15) {
                    $date = $this->getFecha($dias, $horas, $min);

                    if ($date <= \Carbon\Carbon::now()) {

                        if (date('H:i:s', strtotime($date)) > '12:00:00' && date('H:i:s', strtotime($date)) < '15:00:00') {//MAX
                            $humedad = rand(65, 87);

                        } elseif (date('H:i:s', strtotime($date)) > '03:00:00' && date('H:i:s', strtotime($date)) < '06:00:00') {//MIN
                            $humedad = rand(25, 35);
                        } else {//INTERM...
                            $humedad= rand(36,64);
                        }

                        DB::table('humedad')->insert([
                            'humedad' => $humedad,
                            'fecha' => $date,
                            'label_chart'=> $date,
                        ]);
                    }

                }
            }
        }
    }

    public function getFecha($dias, $horas, $min)
    {
        $fecha = \Carbon\Carbon::now()->startOfDay();
        $nuevaF = date('Y-m-d H:i:s', strtotime('-' . $dias . ' day', strtotime($fecha)));
        $nuevaF = date('Y-m-d H:i:s', strtotime('+' . $horas . ' hour', strtotime($nuevaF)));
        $nuevaF = strtotime('+' . $min . ' minute', strtotime($nuevaF));
        $nuevaF = date('Y-m-d H:i:s', $nuevaF);

        return $nuevaF;
    }
}
