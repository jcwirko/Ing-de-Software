<?php

use Illuminate\Database\Seeder;

class TemperaturaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        $temperatura = 10;

        // ULTIMOS 30 DIAS
        for ($dias = 30; $dias >= 0; $dias--) {
            // 50 TEMPERATURAS POR DIA
            for ($horas = 0; $horas <= 23; $horas++) {
                for ($min = 15; $min <= 60; $min += 15) {
                    $date = $this->getFecha($dias, $horas, $min);

                    if ($date <= \Carbon\Carbon::now()) {

                        if (date('H:i:s', strtotime($date)) > '12:00:00' && date('H:i:s', strtotime($date)) < '15:00:00') {//MAX
                            $temperatura = floatVal(rand(25, 38) . '.' . rand(1, 9));

                        } elseif (date('H:i:s', strtotime($date)) > '03:00:00' && date('H:i:s', strtotime($date)) < '06:00:00') {//MIN
                            $temperatura = floatVal(rand(5, 15) . '.' . rand(1, 9));
                        } else {//INTERM...
                            $temperatura = floatVal(rand(16, 24) . '.' . rand(1, 9));
                        }
                        \App\Temperatura::create([
                            'temperatura' => $temperatura,
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
