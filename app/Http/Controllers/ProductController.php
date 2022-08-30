<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Estado;
use App\Models\Product;
use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::orderBy('updated_at', 'DESC')
            ->paginate(env('APP_PAGINATE'));
        return view('productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sucursales = Sucursal::all();
        $categorias = Categoria::all();
        return view('productos.create', compact('sucursales', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|min:3|max:30',
            'precio' => 'required|numeric|digits_between:0,5',
            'descripcion' => 'required|min:3|max:100',
            'categoria' => 'required|exists:App\Models\Categoria,id',
            'sucursal' => 'required|exists:App\Models\Sucursal,id',
            'fecha_compra' => 'required|date'
        ]);

        try {

            Product::create([
                'nombre' => $data['nombre'],
                'descripcion' => $data['descripcion'],
                'precio' => $data['precio'],
                'fecha_compra' => $data['fecha_compra'],
                'categoria_id' => $data['categoria'],
                'sucursal_id' => $data['sucursal'],
                'estado_id' => 1
            ]);

            return redirect()->route('product.index')->with('type', 'success')->with('msg', 'Producto registrado exitosamente.');
        } catch (\Throwable $th) {
            $msg = '';
            if (env('APP_DEBUG')) {
                $msg = $th->getMessage();
            } else {
                $msg = 'Ocurrió un error al registrar información del producto.';
            }
            return redirect()->back()->with('type', 'error')->with('msg', $msg);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $sucursales = Sucursal::all();
        $categorias = Categoria::all();
        $estados = Estado::all();
        return view('productos.edit', compact('product', 'sucursales', 'categorias', 'estados'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            // 'nombre' => 'required|min:3|max:30',
            // 'precio' => 'required|numeric|digits_between:0,5',
            // 'descripcion' => 'required|min:3|max:100',
            // 'categoria' => 'required|exists:App\Models\Categoria,id',
            // 'sucursal' => 'required|exists:App\Models\Sucursal,id',
            // 'fecha_compra' => 'required|date',
            'comentarios' => 'required|max:100',
            'estado' => 'required|exists:App\Models\Estado,id'
        ]);

        try {

            // $product->nombre = $data['nombre'];
            // $product->descripcion = $data['descripcion'];
            // $product->precio = $data['precio'];
            // $product->fecha_compra = $data['fecha_compra'];
            // $product->categoria_id = $data['categoria'];
            // $product->sucursal_id = $data['sucursal'];
            $product->estado_id = $data['estado'];
            $product->comentarios = $data['comentarios'];
            $product->save();

            return redirect()->route('product.index')->with('type', 'success')->with('msg', 'Producto modificado exitosamente.');
        } catch (\Throwable $th) {
            $msg = '';
            if (env('APP_DEBUG')) {
                $msg = $th->getMessage();
            } else {
                $msg = 'Ocurrió un error al modificar la información del producto.';
            }
            return redirect()->back()->with('type', 'error')->with('msg', $msg);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['status' => true, 'msg' => 'Producto eliminado exitosamente', 'type' => 'success']);
        } catch (\Throwable $th) {
            $msg = '';
            if (env('APP_DEBUG')) {
                $msg = $th->getMessage();
            } else {
                $msg = 'Ocurrió un error al eliminar el producto.';
            }
            return response()->json(['status' => false, 'msg' => $msg, 'type' => 'error']);
        }
    }

    public function search(Request $request)
    {
        try {
            // Query
            $busqueda = $request->input('q');

            $productos = Product::with(['categoria', 'sucursal', 'estado'])
                ->join('sucursal', 'sucursal.id', '=', 'producto.sucursal_id')
                ->join('categoria', 'categoria.id', '=', 'producto.categoria_id')
                ->where(function ($q) use ($busqueda) {
                    $q->Where('producto.nombre', 'LIKE', "%$busqueda%")
                        ->orWhere('categoria.nombre', 'LIKE', "%$busqueda%")
                        ->orWhere('sucursal.nombre', 'LIKE', "%$busqueda%")
                        ->orWhere('precio', 'LIKE', "%$busqueda%")
                        ->orWhere(DB::raw('convert(varchar,convert(datetime,producto.fecha_compra,120),23)'), '=', $busqueda)
                        ->orWhere(DB::raw('convert(varchar,convert(datetime,producto.created_at,120),23)'), '=', $busqueda)
                        ->orWhere(DB::raw('convert(varchar,convert(datetime,producto.updated_at,120),23)'), '=', "$busqueda");
                })
                ->orderBy('producto.updated_at', 'desc')
                ->paginate(env('APP_PAGINATE'));

            return view('productos.index', compact('productos'));
        } catch (\Throwable $th) {
            if (env('APP_DEBUG')) {
                $msg = $th->getMessage();
            } else {
                $msg = 'Hubo un problema con tu petición - (Producto - Buscar)';
            }

            return redirect()->back()->with('type', 'error')->with('msg', $msg);
        }
    }
}
