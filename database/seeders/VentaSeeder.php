<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Venta;
use App\Models\Empleado;
use App\Models\Producto;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empleados = Empleado::all();
        $productos = Producto::all();

        if ($empleados->isEmpty() || $productos->isEmpty()) {
            $this->command->warn('No hay empleados o productos para crear ventas. Ejecuta EmpleadoSeeder y ProductoSeeder primero.');
            return;
        }

         // Crear, por ejemplo, 20 ventas
         for ($i = 0; $i < 20; $i++) {
            // Crear la venta base, asociando un empleado al azar
            $venta = Venta::factory()->create([
                'empleado_id' => $empleados->random()->id,
                // 'user_id' => User::inRandomOrder()->first()->id, // Si aplica
            ]);

            // Productos a añadir a esta venta (entre 1 y 5 productos diferentes)
            $productosDeEstaVenta = $productos->random(rand(1, min(5, $productos->count())));
            $totalVentaCalculado = 0;

            $productosParaAdjuntar = []; // Array para guardar los productos con sus datos pivote
$totalVentaCalculado = 0;

foreach ($productosDeEstaVenta as $producto) {
    $cantidad = rand(1, 3); // O la cantidad que desees
    $precioVentaDelProducto = $producto->precio_actual; // Usar el precio actual del producto para el seeder

    // Aquí preparas los datos que irán en la tabla pivote 'producto_venta'
    $productosParaAdjuntar[$producto->id] = [ // La clave es el ID del producto
        'cantidad' => $cantidad,
        'precio' => $precioVentaDelProducto,
        // 'subtotal_linea' => $cantidad * $precioVentaDelProducto, // Si también tienes esta columna
    ];

    $totalVentaCalculado += $cantidad * $precioVentaDelProducto;

    // Opcional: Lógica de stock si la estás simulando
    // if ($producto->stock >= $cantidad) {
    //     $producto->stock -= $cantidad;
    //     $producto->save();
    // } else {
    //     // Manejar el caso de no tener stock para este producto en el seeder
    //     // Quizás no lo añades a $productosParaAdjuntar
    //     unset($productosParaAdjuntar[$producto->id]);
    //     $totalVentaCalculado -= $cantidad * $precioVentaDelProducto; // Revertir el subtotal
    //     $this->command->info("Stock insuficiente para {$producto->nombre} en el seeder, no se añadió a la venta {$venta->id}");
    // }
}

if (!empty($productosParaAdjuntar)) {
    // ¡ESTA ES LA LÍNEA CLAVE PARA POBLAR LA TABLA PIVOTE!
    $venta->productos()->attach($productosParaAdjuntar);

    // Actualizar el total_venta en el modelo Venta
    $venta->total_venta = $totalVentaCalculado;
    $venta->save();
}
        }
    }
}
