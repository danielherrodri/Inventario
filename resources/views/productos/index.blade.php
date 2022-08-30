<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3 space-y-3">
                <div class="flex flex-col md:flex-row items-start space-y-2 md:space-y-0 md:items-center justify-between">
                    <a href="{{route('product.create')}}" class="shadow bg-pink-600 block w-56 cursor-pointer sm:mt-0 hover:shadow-md hover:shadow-rosaIzzi-strong text-white py-2 px-4 focus:outline-none focus:shadow-none rounded text-center transition ease-in duration-200">
                        <button class="flex flex-row items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Registrar producto</span>
                        </button>
                    </a>
                    <form method="get" action="{{route('producto.search')}}" class="flex w-full max-w-sm space-x-3" id="form-search">
                        <input type="search" class="flex-1 appearance-none border border-transparent w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-md rounded-lg text-base focus:outline-none focus:border-gray-600 focus:border-opacity-50 rsc" name="q" placeholder="Buscar producto" autocomplete="off" />
                        <button type="submit" class="flex-shrink-0 bg-pink-600 text-white text-base font-semibold py-2 px-4 rounded-lg hover:shadow-md hover:shadow-rosaIzzi-strong focus:outline-none focus:border-opacity-50 transition ease-in duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75l-2.489-2.489m0 0a3.375 3.375 0 10-4.773-4.773 3.375 3.375 0 004.774 4.774zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="flex flex-col space-y-2">
                    @foreach ($productos as $producto)
                    <div class="border-l-8 text-xs sm:text-sm border-[#13C8C2] rounded-md  min-w-full p-5 bg-white shadow-lg flex flex-wrap items-center">

                        <div class="flex flex-col items-start justify-center w-full md:w-1/6 space-y-2">
                            <div class="flex flex-col items-start justify-center w-full">
                                <h6 class="font-bold">Nombre del producto</h6>
                                <p class="break-words">{{$producto->nombre}}</p>
                            </div>
                            <div class="flex flex-col items-start justify-center w-full">
                                <h6 class="font-bold">Estado</h6>
                                <p>{{$producto->estado->nombre}}</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-start justify-center w-full md:w-1/6">
                            <h6 class="font-bold">Categoría</h6>
                            <p class="break-words w-full md:-28">{{$producto->categoria->nombre}}</p>
                        </div>

                        <div class="flex flex-col items-start justify-center w-full md:w-1/6">
                            <h6 class="font-bold">Sucursal</h6>
                            <p>{{$producto->sucursal->nombre}}</p>
                        </div>

                        <div class="flex flex-col items-start justify-center w-full md:w-1/6 space-y-2">
                            <div class="flex flex-col items-start justify-center w-full">
                                <h6 class="font-bold">Precio</h6>
                                <p class="break-words">{{$producto->precio}}</p>
                            </div>
                            <div class="flex flex-col items-start justify-center w-full">
                                <h6 class="font-bold">Fecha de compra</h6>
                                <p>{{$producto->fecha_compra}}</p>
                            </div>
                        </div>

                        <div class="flex flex-col items-start justify-center w-full md:w-1/6 space-y-2">
                            <div class="flex flex-col items-start justify-center w-full">
                                <h6 class="font-bold">Fecha creada</h6>
                                <p name="fecha">{{$producto->created_at}}</p>
                            </div>
                            <div class="flex flex-col items-start justify-center w-full">
                                <h6 class="font-bold">Fecha actualizada</h6>
                                <p name="fecha">{{$producto->created_at}}</p>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center space-y-2 w-full mt-2 lg:mt-0 md:w-1/6">
                            <a href="{{route('product.show',['product'=>$producto->id])}}"><button class="shadow bg-[#E44988] w-32 hover:shadow-md hover:shadow-verdeIzzi-strong text-white py-1 px-3 text-sm focus:outline-none rounded text-center transition ease-in duration-200">Ver registro</button></a>
                            @if(Auth::check() && Auth::user()->rol->id==2)
                            <button name="eliminar_producto" type="button" class="shadow bg-[#494D4F] w-32 hover:shadow-md hover:shadow-rosaIzzi-strong text-white py-1 px-3 text-sm focus:outline-none rounded  text-center transition ease-in duration-200" data-id="{{$producto->id}}">Eliminar</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($productos->count()==0)
                <div class="flex justify-center mt-5">
                    <div class="w-full border-l-8 text-xs sm:text-sm border-pink-600 rounded-md p-10 bg-white shadow-lg flex flex-row justify-center items-center space-x-3">
                        <img src="{{asset('img/info.png')}}" class="h-12 w-12" alt="Info">
                        <p class="font-bold uppercase tracking-wide">No hay información disponible por el momento. </p>
                    </div>
                </div>
                @endif
                <div class="flex justify-end mt-3">
                    {{ $productos->appends(request()->query())->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>