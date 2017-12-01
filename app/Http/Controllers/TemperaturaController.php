<?php

namespace App\Http\Controllers;

use App\Temperatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemperaturaController extends Controller
{
    public function getTemperaturaMax()
    {
        $max = DB::table('temperatura')->whereDate('fecha', '=', Date('Y-m-d'))
            ->orderBy('temperatura', 'DESC')
            ->first();

        $max->fecha = Date('H:i', strtotime($max->fecha)) . ' hs';

        return response()->json($max);
    }

    public function getTemperaturaMin()
    {
        $min = DB::table('temperatura')->whereDate('fecha', '=', Date('Y-m-d'))
            ->orderBy('temperatura', 'ASC')
            ->first();

        $min->fecha = Date('H:i', strtotime($min->fecha)) . ' hs';

        return response()->json($min);
    }

    public function getTemperaturaActual()
    {
        $min = DB::table('temperatura')->whereDate('fecha', '<', Date('Y-m-d H:i:s'))
            ->orderBy('fecha', 'DESC')
            ->first();

        $min->fecha = Date('H:i', strtotime($min->fecha)) . ' hs';

        return response()->json($min);
    }

    public function getTemperaturaMaxMonthly()
    {
        return response()->json(DB::table('temperatura')->max('temperatura'));
    }

    public function getTemperaturaMinMonthly()
    {
        return response()->json(DB::table('temperatura')->min('temperatura'));
    }

    public function getLabels()
    {
        $temperatura = Temperatura::distinct('label_chart')->orderBy('label_chart', 'ASC')->select('label_chart')->get();

        return response()->json($temperatura);
    }

    public function getDataChart()
    {
       $data = DB::select('
            SELECT max(temperatura) as max,min(temperatura) as min, label_chart as fecha, avg(temperatura) as avg
            FROM temperatura
            WHERE label_chart in (
                SELECT DISTINCT label_chart 
                FROM temperatura
                ORDER BY label_chart ASC                              
            )
            GROUP BY label_chart
      ');

        return response()->json($data);
    }
}
