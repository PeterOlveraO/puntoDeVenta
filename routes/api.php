<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\VentaController;

Route::apiResource('productos', ProductoController::class);

Route::apiResource('empleados', EmpleadoController::class);

Route::apiResource('ventas', VentaController::class);