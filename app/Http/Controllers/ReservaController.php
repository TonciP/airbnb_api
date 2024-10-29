<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    function getByIdLugar(string $lugarId)
    {
        $reserva = Reserva::where('lugar_id', $lugarId)->first();
        if ($reserva === null) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }
        return response()->json($reserva);
    }

    function getByIdCliente(string $clienteId)
    {
        $reserva = Reserva::where('cliente_id', $clienteId)->get();
        if ($reserva === null) {
            return response()->json(['message' => 'Reserva no encontrada'], 404);
        }
        return response()->json($reserva);
    }

    function saveReserva(Request $request)
    {
        $request->validate([
            'lugar_id' => 'required|string',
            'cliente_id' => 'required|string',
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'costoTotal' => 'required|numeric',
        ]);

        $reserva = new Reserva();
        $reserva->lugar_id = $request->lugar_id;
        $reserva->cliente_id = $request->cliente_id;
        $reserva->fechaInicio = $request->fechaInicio;
        $reserva->fechaFin = $request->fechaFin;
        $reserva->costoTotal = $request->costoTotal;
        $reserva->save();
        return response()->json($reserva);

    }
}
