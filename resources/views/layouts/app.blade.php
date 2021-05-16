<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/layouts.css') }}">
        <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    
        @livewireStyles
        @stack('styles')

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-dropdown')
            <!--aqui va el livewire navigation-dropdown-->

            <!-- sidebar -->
            <div id="sidebar" class="h-screen w-16 menu bg-white text-white px-4 flex items-center nunito static fixed shadow">

                <ul class="list-reset ">
                    @if( Auth::user()->tipo_user == 1 )
                        @include('menu.alumnos')
                    @elseif( Auth::user()->tipo_user == 2 )
                        @include('menu.docente')
                    @endif
                </ul>
        
            </div>

            <!--contenido-->
            <div class="flex flex-row flex-wrap flex-1 flex-grow content-start pl-16">
                <div class="w-full flex-1">
                    <main>
                        {{ $slot }}
                    </main>
                </div>
            </div>
            <!--end contenido-->
        
            <!--end sidebar-->
            <!--<div class="bg-white shadow w-56 h-screen">
                <div class="">
                    <h4>texto</h4>
                </div>
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </div>-->


        </div>

        @stack('modals')

        @livewireScripts
        @stack('scripts')
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('js/invitado.js') }}"></script>
    </body>
</html>
