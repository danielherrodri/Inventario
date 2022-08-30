<?php

namespace Database\Factories;

use App\Models\Categoria;
use App\Models\Product;
use App\Models\Sucursal;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductosFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arreglo = ['Carbón', 'Metal', 'Pantalones', 'Playeras', 'Frutas', 'Verduras', 'Laptops'];
        return [
            'nombre' => $arreglo[array_rand($arreglo)],
            'descripcion' => substr($this->faker->text(), 0, 100),
            'precio' => rand(100, 900),
            'fecha_compra' => $this->faker->date(),
            'estado_id' => 1,
            'categoria_id' => (Categoria::inRandomOrder()->first())->id,
            'sucursal_id' => (Sucursal::inRandomOrder()->first())->id
        ];
    }
}
