<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;

class ProductoController extends Controller
{
    
    public function index()
    {
        $productos = Producto::all();
        return response()->json($productos, 200);
    }

    public function store(StoreProductoRequest $request)
    {
        $validated = $request->validated();
        $producto = Producto::create($validated);

        return response()->json([
            'message' => 'Producto creado exitosamente',
            'data' => $producto
        ], 201);    
    }

    public function show(Producto $producto)
    {
        return response()->json([
            'message' => 'Producto encontrado exitosamente',
            'data' => $producto
        ], 200);
    }

    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        $validatedData = $request->validated();
        $producto->update($validatedData);

        return response()->json([
            'message' => 'Producto actualizado exitosamente',
            'data' => $producto
        ], 200);
    }
}
