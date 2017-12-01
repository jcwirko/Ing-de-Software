<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Sensor;
use Illuminate\Http\Request;
use Alert;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        $sensores = Sensor::get();

        return view('admin.index', compact('sensores'));
    }

    public function encenderTodo()
    {

        DB::table('sensor')->update([
            'estado' => 1
        ]);

        Alert::success('Sensores encendidos correctamente');

        return redirect()->back();
    }

    public function apagarTodo()
    {

        DB::table('sensor')->update([
            'estado' => 0
        ]);

        Alert::success('Sensores apagados correctamente');

        return redirect()->back();
    }

    public function testearTodo()
    {
        $sensores = DB::table('sensor')->where('estado', 2)->get();
        if (count($sensores) > 0) {
            Alert::error('Por favor, revisar el panel de sensores','Error en uno de los sensores')->persistent('Cerrar');
        } else {
            Alert::success('Los sensores se encuentran en óptimas condiciones');
        }

        return redirect()->back();
    }

    public function apagarEncenderSensor(Request $r, $id_sensor)
    {

        $sensor = Sensor::where('id', $id_sensor)->first();

        $probabilidad = rand($this->probabilidad($sensor->id), 100);

        if ($probabilidad >= 85) {
            $sensor->estado = 2;

            $sensor->save();

            Alert::error('Ocurrió un fallo en el ' . $sensor->sensor);
        } else {

            if ($sensor->estado) {
                $sensor->estado = 0;

                $sensor->save();

                Alert::success('El ' . $sensor->sensor . ' se apagó correctamente.');
            } elseif (!$sensor->estado) {
                $sensor->estado = 1;

                $sensor->save();

                Alert::success('El ' . $sensor->sensor . ' se encendió correctamente.');
            }
        }


        return redirect()->back();

    }

    private function probabilidad($id)
    {

        switch ($id) {
            case 1:
                return 10;
                break;
            case 2:
                return 85;
                break;
            case 3:
                return 20;
                break;
            case 4:
                return 10;
                break;
            case 5:
                return 15;
                break;
            case 6:
                return 20;
                break;
        }
    }

    public function calibrarSensor(Request $r, $id_sensor)
    {

        $sensor = Sensor::where('id', $id_sensor)->first();

        $sensor->estado = 1;

        $sensor->save();

        Alert::success('El ' . $sensor->sensor . ' se calibró correctamente.');

        return redirect()->back();

    }

}
