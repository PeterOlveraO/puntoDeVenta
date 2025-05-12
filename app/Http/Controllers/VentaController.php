<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Http\Requests\StoreVentaRequest;
use App\Http\Requests\UpdateVentaRequest;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with(['empleado', 'productos'])->get();
        return response()->json($ventas, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVentaRequest $request)
    {
        $validated = $request->validated();
        
        // Calcular el monto total
        $montoTotal = 0;
        foreach ($validated['productos'] as $producto) {
            $montoTotal += $producto['cantidad'] * $producto['precio'];
        }

        // Crear la venta
        $venta = Venta::create([
            'empleado_id' => $validated['empleado_id'],
            'metodo_pago' => $validated['metodo_pago'],
            'monto_total' => $montoTotal
        ]);

        // Preparar los productos para la tabla pivote
        $productosParaAdjuntar = [];
        foreach ($validated['productos'] as $producto) {
            $productosParaAdjuntar[$producto['producto_id']] = [
                'cantidad' => $producto['cantidad'],
                'precio' => $producto['precio'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Adjuntar los productos a la venta
        $venta->productos()->attach($productosParaAdjuntar);

        // Cargar las relaciones para la respuesta
        $venta->load(['empleado', 'productos']);

        return response()->json([
            'message' => 'Venta creada exitosamente',
            'data' => $venta
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta->load(['empleado', 'productos']);
        return response()->json([
            'message' => 'Venta encontrada exitosamente',
            'data' => $venta
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVentaRequest $request, Venta $venta)
    {
        $validatedData = $request->validated();
        $venta->update($validatedData);

        $venta->load(['empleado', 'productos']);
        return response()->json([
            'message' => 'Venta actualizada exitosamente',
            'data' => $venta
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
