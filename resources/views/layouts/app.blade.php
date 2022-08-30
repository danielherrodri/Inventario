<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="api-base-url" content="{{ url('') }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link rel="icon" href="{{ URL::asset('img/warehouse.png') }}" type="image/x-icon" />
</head>

<body class="font-sans antialiased relative">
    @include('shared.spinner')
    <div id="actionMsg" data-msg="@if(session('msg')) {{session('msg')}} @endif" data-type="@if(session('type')) {{session('type')}} @endif"></div>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>

        <footer class="absolute w-full bottom-0 flex items-center justify-center bg-white p-1">
            <span class="font-bold text-pink-500 uppercase">Daniel Rodriguez Herrera</span>
        </footer>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/productos.js')}}"></script>
    <script src="{{asset('js/usuarios.js')}}"></script>
</body>

</html>