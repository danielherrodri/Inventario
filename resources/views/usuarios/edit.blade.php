<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
                <form method="post" action="{{route('usuario.update',['usuario'=>$usuario->id])}}" class="p-6 bg-white border-b border-gray-200 space-y-5">
                    <h3 name="titulo" class="text-center text-lg font-bold font-sans text-azul-strong uppercase">Información del usuario</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        @csrf
                        @method('put')
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="nombre">
                                Nombre
                            </label>
                            <input value="{{old('nombre', $usuario->name)}}" name="nombre" class="appearance-none block w-full text-gray-700
                                border rounded py-3 px-4 leading-tight 
                                focus:outline-none border-gray-800 text-sm" placeholder="Ingresa el nombre del producto">
                            @error('nombre')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class=" block text-gray-700 text-sm leading-tight font-bold mb-2" for="apematerno">
                                Apellido Materno
                            </label>
                            <input value="{{old('apematerno', $usuario->lastName)}}" class="required appearance-none block w-full text-gray-700 
                                border rounded py-3 px-4 leading-tight text-sm
                                focus:outline-none border-gray-800" name="apematerno" id="apematerno" type="text" placeholder="Ingresa el apellido materno">
                            @error('apematerno')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class=" block text-gray-700 text-sm leading-tight font-bold mb-2" for="apepaterno">
                                Apellido Paterno
                            </label>
                            <input value="{{old('apepaterno',$usuario->firstName)}}" class="required appearance-none block w-full text-gray-700 
                                border rounded py-3 px-4 leading-tight text-sm
                                focus:outline-none border-gray-800" name="apepaterno" id="apepaterno" type="text" placeholder="Ingresa el apellido paterno">
                            @error('apepaterno')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class=" block text-gray-700 text-sm leading-tight font-bold mb-2" for="email">
                                Correo electrónico
                            </label>
                            <input value="{{old('email',$usuario->email)}}" class="required appearance-none block w-full text-gray-700 
                                border rounded py-3 px-4 leading-tight text-sm
                                focus:outline-none border-gray-800" name="email" id="email" type="email" placeholder="Ingresa el email electrónico">
                            @error('email')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="rol">
                                Selecciona el rol
                            </label>
                            <select name="rol" class="required block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" id="rol" placeholder="Ingresa el rol del usuario">
                                <option value="">Selecciona una opción</option>
                                @if(isset($roles))
                                @foreach ($roles as $rol)
                                <option {{old('rol',$usuario->rol_id)==$rol->id? 'selected': ''}} value="{{$rol->id}}">{{$rol->nombre}}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('rol')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="acceso">
                                Selecciona el acceso
                            </label>
                            <select name="acceso" class="required block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none border-gray-800 text-sm" id="acceso" placeholder="Ingresa el acceso del usuario">
                                <option value="">Selecciona una opción</option>
                                <option {{old('acceso',$usuario->acceso==1?'selected':'')}} value="1">Permitido</option>
                                <option {{old('acceso',$usuario->acceso==0?'selected':'')}} value="0">Denegado</option>
                            </select>
                            @error('acceso')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="password">
                                Contraseña
                            </label>
                            <input value="{{old('password')}}" type="password" name="password" class="appearance-none block w-full text-gray-700
                                border rounded py-3 px-4 leading-tight 
                                focus:outline-none border-gray-800 text-sm" placeholder="">
                            @error('password')
                            <p class="text-red-700 text-semibold text-xs pb-1">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col">
                            <label class="block text-gray-700 text-sm leading-tight font-bold mb-2" for="password_confirmation">
                                Contraseña confirmación
                            </label>
                            <input value="{{old('password_confirmation')}}" type="password" name="password_confirmation" class="appearance-none block w-full text-gray-700
                                border rounded py-3 px-4 leading-tight 
                                focus:outline-none border-gray-800 text-sm" placeholder="">
                            @error('password_confirmation')
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