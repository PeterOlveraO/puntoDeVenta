<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EmpleadoController;

Route::apiResource('productos', ProductoController::class);

Route::apiResource('empleados', EmpleadoController::class);