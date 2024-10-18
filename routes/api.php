<?php

use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoControlles;
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


Route::get('/empleados/{id}', [EmpleadoControlles::class, 'show']);
Route::post('/empleados', [EmpleadoControlles::class, 'store']);
Route::put('/empleados/{id}/status', [EmpleadoControlles::class, 'updateStatus']);
Route::delete('/empleados/{id}', [EmpleadoControlles::class, 'destroy']);
Route::get('/empleados', [EmpleadoControlles::class, 'index']);

Route::get('/departamentos', [DepartamentoController::class, 'index']);
Route::get('/departamentos/{id}', [DepartamentoController::class, 'show']);