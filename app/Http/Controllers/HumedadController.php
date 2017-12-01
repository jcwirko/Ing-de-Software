<?php

namespace App\Http\Controllers;

use App\Humedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HumedadController extends Controller
{
    public function getHumedadMax()
    {
        $max = DB::table('humedad')->whereDate('fecha', '=', Date('Y-m-d'))
            ->orderBy('humedad', 'DESC')
            ->first();

        $max->fecha = Date('H:i', strtotime($max->fecha)) . ' hs';

        return response()->json($max);
    }

    public function getHumedadMin()
    {
        $min = DB::table('humedad')->whereDate('fecha', '=', Date('Y-m-d'))
            ->orderBy('humedad', 'ASC')
            ->first();

        $min->fecha = Date('H:i', strtotime($min->fecha)) . ' hs';

        return response()->json($min);
    }

    public function getHumedadActual()
    {
        $min = DB::table('humedad')->whereDate('fecha', '<', Date('Y-m-d H:i:s'))
            ->orderBy('fecha', 'DESC')
            ->first();

        $min->fecha = Date('H:i', strtotime($min->fecha)) . ' hs';

        return response()->json($min);
    }

    public function getHumedadMaxMonthly()
    {
        return response()->json(DB::table('humedad')->max('humedad'));
    }

    public function getHumedadMinMonthly()
    {
        return response()->json(DB::table('humedad')->min('humedad'));
    }

    public function getLabels()
    {
        $humedad = DB::table('humedad')->distinct('label_chart')->orderBy('label_chart', 'ASC')->select('label_chart')->get();

        return response()->json($humedad);
    }

    public function getDataChart()
    {
       $data = DB::select('
            SELECT max(humedad) as max,min(humedad) as min, label_chart as fecha, avg(humedad) as avg
            FROM humedad
            WHERE label_chart in (
                SELECT DISTINCT label_chart 
                FROM humedad
                ORDER BY label_chart ASC                              
            )
            GROUP BY label_chart
      ');

        return response()->json($data);
    }
}
