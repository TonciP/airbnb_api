<?php

use App\Http\Controllers\ArrendatarioController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/hola', function () {
    return response()->json(['message' => 'Hola mundo']);
});

Route::get('/users', [UserController::class, 'GetAll']);
Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users', [UserController::class, 'save']);

Route::post('/arrendatario/login', [ArrendatarioController::class, 'login']);
Route::post('/arrendatario', [ArrendatarioController::class, 'save']);

Route::get('/lugar/{id}', [LugarController::class, 'getLugarById']);
Route::post('/lugar/search', [LugarController::class, 'searchLugar']);
Route::post('/lugar/search/avance', [LugarController::class, 'searchLugarAvance']);
Route::post('/lugar', [LugarController::class, 'guardarLugar']);
Route::post('/lugar/{id}/foto', [LugarController::class, 'guardarFotoById']);

Route::get('/reserva/lugar/{lugar_id}', [ReservaController::class, 'getByIdLugar']);
Route::get('/reserva/cliente/{clienteId}', [ReservaController::class, 'getByIdCliente']);
Route::post('/reserva', [ReservaController::class, 'saveReserva']);
