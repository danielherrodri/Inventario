<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Sucursal;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Sucursal::create([
            'nombre' => 'Cuernavaca'
        ]);
        Sucursal::create([
            'nombre' => 'Yautepec'
        ]);
        Sucursal::create([
            'nombre' => 'Cuautla'
        ]);
        Sucursal::create([
            'nombre' => 'Acapulco'
        ]);

        Categoria::create([
            'nombre' => 'Electrónica'
        ]);
        Categoria::create([
            'nombre' => 'Línea Blanca'
        ]);
        Categoria::create([
            'nombre' => 'Deportes'
        ]);
        Categoria::create([
            'nombre' => 'Alimentos y Jardín'
        ]);

        Estado::create([
            'nombre' => 'Abierto'
        ]);
        Estado::create([
            'nombre' => 'Cerrado'
        ]);
    }
}
