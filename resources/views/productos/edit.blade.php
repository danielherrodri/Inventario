<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <form method="post" action="{{route('product.update',['product'=>$product->id])}}" class="p-6 bg-white border-b border-gray-200 space-y-5">
                    <h3 name="titulo" class="text-center text-lg font-bold font-sans text-azul-strong uppercase">{{$product->nombre}}</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @csrf
                        @method('put')
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="nombre">
                                Nombre del producto
                            </label>
                            <input disabled value="{{old('nombre', $product->nombre)}}" name="nombre" class="appearance-none block w-full text-gray-700
                                border rounded py-3 px-4 leading-tight 
                                focus:outline-none border-gray-800 text-sm" placeholder="Ingresa el nombre del producto">
                            @error('nombre')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class=" block text-gray-700 text-sm leading-tight font-bold mb-2" for="precio">
                                Precio
                            </label>
                            <input disabled value="{{old('precio', $product->precio)}}" class="required appearance-none block w-full text-gray-700 
                                border rounded py-3 px-4 leading-tight text-sm
                                focus:outline-none border-gray-800" name="precio" id="precio" type="number" placeholder="Ingresa el precio del producto">
                            @error('precio')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="descripcion">
                                Descripción
                            </label>
                            <textarea disabled name="descripcion" class="appearance-none block w-full text-gray-700
                                border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" placeholder="Ingresa la descripción del producto">{{old('descripcion', $product->descripcion)}}</textarea>
                            @error('descripcion')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="categoria">
                                Categoría
                            </label>
                            <select disabled name="categoria" class="required block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" id="categoria" placeholder="Ingresa el tipo de campaña">
                                <option value="">Selecciona una opción</option>
                                @if(isset($categorias))
                                @foreach ($categorias as $categoria)
                                <option {{old('categoria', $product->categoria->id)==$categoria->id? 'selected': ''}} value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('categoria')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class=" block text-gray-700 text-sm leading-tight font-bold mb-2" for="sucursal">
                                Sucursal
                            </label>
                            <select disabled class="required block w-full text-gray-700 
                                border rounded py-3 px-4 leading-tight 
                                focus:outline-none border-gray-800 text-sm" name="sucursal" id="sucursal" type="text">
                                <option value="">Selecciona una opción</option>
                                @if(isset($sucursales))
                                @foreach ($sucursales as $sucursal)
                                <option {{old('sucursal', $product->sucursal->id)==$sucursal->id? 'selected': ''}} value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('sucursal')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class=" block text-gray-700 text-sm leading-tight font-bold mb-2" for="fecha_compra">
                                Fecha de compra
                            </label>
                            <input disabled type="date" value="{{old('fecha_compra', $product->fecha_compra)!==null? \Carbon\Carbon::parse(old('fecha_compra', $product->fecha_compra))->format('d/m/Y') : ''}}" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" name="fecha_compra" id="fecha_compra">
                            @error('fecha_compra')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class=" block text-gray-700 text-sm leading-tight font-bold mb-2" for="estado">
                                Estado
                            </label>
                            <select {{Auth::user()->rol->id==1? 'disabled':''}} class="block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" name="estado" id="estado">
                                <option value="">Selecciona una opción</option>
                                @if(isset($estados))
                                @foreach ($estados as $estado)
                                <option {{old('estado', $product->estado_id) == $estado->id? 'selected':'' }} value="{{$estado->id}}">{{$estado->nombre}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('estado')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col md:col-span-2">
                            <label class=" block text-gray-700 text-sm leading-tight font-bold mb-2" for="comentarios">
                                Comentarios
                            </label>
                            <textarea {{Auth::user()->rol->id==1? 'disabled':''}} class="block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" name="comentarios" id="comentarios" placeholder="Ingresa un comentario">{{old('comentarios', $product->comentarios)}}</textarea>
                            @error('comentarios')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" value="{{old('fecha_compra', $product->fecha_compra)}}" id="fecha_compra_hidden">
                    @if(Auth::check() && Auth::user()->rol->id==2)
                    <div class="flex flex-col w-full md:flex-row justify-center space-y-5 md:space-x-5 md:space-y-0">
                        <button type="reset" class="shadow bg-gray-700 md:w-32 hover:shadow-md hover:shadow-grisIzzi-strong text-white py-2 px-3 text-sm focus:outline-none rounded text-center transition ease-in duration-200" id="btnCancel">Cancelar</button>
                        <button type="submit" class="shadow bg-pink-600 md:w-32 hover:shadow-md hover:shadow-rosaIzzi-strong text-white py-2 px-3 text-sm focus:outline-none rounded  text-center md:mt-3 transition ease-in duration-200" id="btnSubmit">Modificar</button>
                    </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>