<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductionLineController;
use App\Http\Controllers\Api\MaintenanceOrderController;
use App\Http\Controllers\Api\MachineController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/operativasPorLinea', [MachineController::class, 'operativasPorLinea']);
Route::get('/porCriticidad', [MachineController::class, 'porCriticidad']);
Route::get('/disponibles', [MachineController::class, 'disponibles']);
Route::get('/sinFinalizar', [MaintenanceOrderController::class, 'sinFinalizar']);
Route::get('/conCostoReal', [MaintenanceOrderController::class, 'conCostoReal']);

Route::get('/conOrdenesPendientes', [MachineController::class, 'conOrdenesPendientes']);
Route::get('/conCorrectivo', [MachineController::class, 'conCorrectivo']);
Route::get('/sinOrdenes', [MachineController::class, 'sinOrdenes']);

Route::get('/tiposDeMaquinas', [MachineController::class, 'tiposDeMaquinas']);
Route::get('/maquinasActivasConOrdenesPendientes', [MachineController::class, 'maquinasActivasConOrdenesPendientes']);
