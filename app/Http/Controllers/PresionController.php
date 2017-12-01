<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresionController extends Controller
{


    public function getPresionActual()
    {
        $presion = DB::table('presion_atmosferica')->first();

        return response()->json($presion);
    }


}
