<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <form method="post" action="{{route('product.store')}}" class="p-6 bg-white border-b border-gray-200 space-y-5">
                    <h3 name="titulo" class="text-center text-lg font-bold font-sans text-azul-strong uppercase">Información del producto</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @csrf
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="nombre">
                                Nombre del producto
                            </label>
                            <input value="{{old('nombre')}}" name="nombre" class="appearance-none block w-full text-gray-700
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
                            <input value="{{old('precio')}}" class="required appearance-none block w-full text-gray-700 
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
                            <textarea name="descripcion" class="appearance-none block w-full text-gray-700
                                border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" placeholder="Ingresa la descripción del producto">{{old('descripcion')}}</textarea>
                            @error('descripcion')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="categoria">
                                Categoría
                            </label>
                            <select name="categoria" class="required block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" id="categoria" placeholder="Ingresa el tipo de campaña">
                                <option value="">Selecciona una opción</option>
                                @if(isset($categorias))
                                @foreach ($categorias as $categoria)
                                <option {{old('categoria')==$categoria->id? 'selected': ''}} value="{{$categoria->id}}">{{$categoria->nombre}}</option>
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
                            <select class="required block w-full text-gray-700 
                                border rounded py-3 px-4 leading-tight 
                                focus:outline-none border-gray-800 text-sm" name="sucursal" id="sucursal" type="text">
                                <option value="">Selecciona una opción</option>
                                @if(isset($sucursales))
                                @foreach ($sucursales as $sucursal)
                                <option {{old('sucursal')==$sucursal->id? 'selected': ''}} value="{{$sucursal->id}}">{{$sucursal->nombre}}</option>
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
                            <input type="date" value="{{old('fecha_compra')!==null? \Carbon\Carbon::parse(old('fecha_compra'))->format('d/m/Y') : ''}}" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" name="fecha_compra" id="fecha_compra">
                            @error('fecha_compra')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-col w-full md:flex-row justify-center space-y-5 md:space-x-5 md:space-y-0">
                        <button type="reset" class="shadow bg-gray-700 md:w-32 hover:shadow-md hover:shadow-grisIzzi-strong text-white py-2 px-3 text-sm focus:outline-none rounded text-center transition ease-in duration-200" id="btnCancel">Cancelar</button>
                        <button type="submit" class="shadow bg-pink-600 md:w-32 hover:shadow-md hover:shadow-rosaIzzi-strong text-white py-2 px-3 text-sm focus:outline-none rounded  text-center md:mt-3 transition ease-in duration-200" id="btnSubmit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>