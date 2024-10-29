<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Models\Lugar;
use Illuminate\Http\Request;


class LugarController extends Controller
{
    function getLugarById(string $id)
    {


        $lugar = Lugar::with('fotos')->where('id', $id)->first();
        if ($lugar === null) {
            return response()->json(['message' => 'Lugar no encontrado'], 404);
        }
        return response()->json($lugar);
    }

    function searchLugar(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);

        $lugar = Lugar::where('nombre', 'like', '%' . $request->nombre . '%')->get();
        return response()->json($lugar);
    }

    function searchLugarAvance(Request $request)
    {
        $request->validate([
            'search' => 'required|string'
        ]);

        $lugar = Lugar::where('nombre', 'like', '%' . $request->nombre . '%')
        ->orWhere('descripcion', 'like', '%' . $request->descripcion . '%')
        ->orWhere('ciudad', 'like', '%' . $request->ciudad . '%')
        ->get();
        return response()->json($lugar);
    }

    function guardarLugar(Request $request)
    {

        $request->validate([
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
            'cantPersonas' => 'required|integer',
            'cantCamas' => 'required|integer',
            'cantBanios' => 'required|integer',
            'cantHabitaciones' => 'required|integer',
            'tieneWifi' => 'required|integer',
            'cantVehiculosParqueo' => 'required|integer',
            'precioNoche' => 'required|numeric',
            'costoLimpieza' => 'required|numeric',
            'ciudad' => 'required|string',
            'latitud' => 'required|string',
            'longitud' => 'required|string',
            'arrendatario_id' => 'required|integer',
        ]);

        $lugar = new Lugar();
        $lugar->nombre = $request->nombre;
        $lugar->descripcion = $request->descripcion;
        $lugar->cantPersonas = $request->cantPersonas;
        $lugar->cantCamas = $request->cantCamas;
        $lugar->cantBanios = $request->cantBanios;
        $lugar->cantHabitaciones = $request->cantHabitaciones;
        $lugar->tieneWifi = $request->tieneWifi;
        $lugar->cantVehiculosParqueo = $request->cantVehiculosParqueo;
        $lugar->precioNoche = $request->precioNoche;
        $lugar->costoLimpieza = $request->costoLimpieza;
        $lugar->ciudad = $request->ciudad;
        $lugar->latitud = $request->latitud;
        $lugar->longitud = $request->longitud;
        $lugar->arrendatario_id = $request->arrendatario_id;
        $lugar->save();

        return response()->json($lugar);
    }

    function guardarFotoById(Request $request,string $id)
    {
        $request->validate([
            'foto' => 'required|image'
        ]);

        $lugar = Lugar::where('id', $id)->first();
        if ($lugar === null) {
            return response()->json(['message' => 'Lugar no encontrado'], 404);
        }

        $foto = $request->file('foto');
        $nombre = $foto->getClientOriginalName();
        $foto->move(public_path('fotos'), $nombre);

        $url = env('APP_URL') . ':8000/fotos/' . $nombre;
        /*$domain = 'http://localhost:8000';
        $url = '/fotos/image.jpg';*/

        if (!file_exists(public_path('fotos/' . $nombre))) {
            $fotos = new Foto();
            $fotos->url = $url;
            $fotos->lugar_id = $id;

            $fotos->save();
        }


        //$lugar->fotos = $nombre;
        //$lugar->save();

        return response()->json($lugar->with('fotos')->get());
    }
}
