<?php

use Illuminate\Database\Seeder;

class SensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TEMPERATURA
        DB::table('sensor')->insert([
            'sensor' => 'Termómetro',
            'numero_serie' => ucwords($this->generateRandomString(8)),
            'modelo' => strtolower($this->generateRandomString(5)),
        ]);

        //PRECIPITACIONES
        DB::table('sensor')->insert([
            'sensor' => 'Pluviómetro',
            'numero_serie' => ucwords($this->generateRandomString(8)),
            'modelo' => strtolower($this->generateRandomString(5)),
        ]);

        //HUMEDAD
        DB::table('sensor')->insert([
            'sensor' => 'Higrómetro',
            'numero_serie' => ucwords($this->generateRandomString(8)),
            'modelo' => strtolower($this->generateRandomString(5)),
        ]);

        //PRESION ATMOSFERICA
        DB::table('sensor')->insert([
            'sensor' => 'Barómetro',
            'numero_serie' => ucwords($this->generateRandomString(8)),
            'modelo' => strtolower($this->generateRandomString(5)),
        ]);

        //VIENTO
        DB::table('sensor')->insert([
            'sensor' => 'Anemómetro',
            'numero_serie' => ucwords($this->generateRandomString(8)),
            'modelo' => strtolower($this->generateRandomString(5)),
        ]);

        //INSOLACIÓN / RADIACION SOLAR
        DB::table('sensor')->insert([
            'sensor' => 'Heliógrafo',
            'numero_serie' => ucwords($this->generateRandomString(8)),
            'modelo' => strtolower($this->generateRandomString(5)),
        ]);
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
