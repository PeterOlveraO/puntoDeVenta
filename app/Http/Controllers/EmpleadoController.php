<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Http\Requests\StoreEmpleadoRequest;
use App\Http\Requests\UpdateEmpleadoRequest;

class EmpleadoController extends Controller
{
    
    public function index()
    {
        $empleados = Empleado::all();
        return response()->json($empleados, 200);
    }

    public function store(StoreEmpleadoRequest $request)
    {
        $validated = $request->validated();
        $empleado = Empleado::create($validated);

        return response()->json([
            'message' => 'Empleado creado exitosamente',
            'data' => $empleado
        ], 201);
    }

    public function show(Empleado $empleado)
    {
        return response()->json([
            'message' => 'Empleado encontrado exitosamente',
            'data' => $empleado
        ], 200);
    }

    public function update(UpdateEmpleadoRequest $request, Empleado $empleado)
    {
        $validatedData = $request->validated();
        $empleado->update($validatedData);

        return response()->json([
            'message' => 'Empleado actualizado exitosamente',
            'data' => $empleado
        ], 200);
    }

}
