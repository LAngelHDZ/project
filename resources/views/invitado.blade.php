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
        @livewireStyles
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>
    </head>
    <body class="font-sans antialiased">

      <div class="min-h-screen bg-gray-100">
        <nav class="bg-gray-800">
          <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <img src="{{ asset('img/logo.jpeg') }}" alt="logo tecnologico" width="50px" height="50px">
                </div>
                <div class="hidden md:block">
                  <div class="ml-10 flex items-baseline space-x-4">
                    <button class="px-3 py-2 rounded-md text-sm font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700">Dashboard</button>
                  </div>
                </div>
              </div>
              <div class="hidden md:block">
                <div class="ml-4 flex items-center md:ml-6">
                  <a href="{{ route('login') }}" class="px-3 py-2 rounded-full text-sm font-medium text-gray-300 hover:text-white
                  hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"> Iniciar Sesion</a>
                  <a href="{{ route('register') }}" class="px-3 py-2 rounded-full text-sm font-medium text-gray-300 hover:text-white
                  hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"> Registrarme</a>
                </div>
              </div>
              <div class="-mr-2 flex md:hidden">
                <a href="{{ route('login') }}" class="px-3 py-2 rounded-full text-sm font-medium text-gray-300 hover:text-white
                  hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"> Iniciar Sesion</a>
                <a href="{{ route('register') }}" class="px-3 py-2 rounded-full text-sm font-medium text-gray-300 hover:text-white
                  hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700"> Registrarme</a>
                <!-- Mobile menu button -->
                <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
                  <!-- Menu open: "hidden", Menu closed: "block" -->
                  <!--<svg class="block h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                  </svg>-->
                  <!-- Menu open: "block", Menu closed: "hidden" -->
                  <!--<svg class="hidden h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>-->
                </button>
              </div>
            </div>
          </div>
        </nav>
        
        <!-- Page Heading -->
        <header class="bg-white shadow">
          <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
              Dashboard
            </h1>
          </div>
        </header>
        
        <!-- Page Content -->
        <main>
          <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Replace with your content -->
            <div class="px-4 py-6 sm:px-0">
              <h1 class="font-sans text-5xl text-gray-800">Materias</h1>
              <div class="border-4 border-dashed border-gray-200 rounded-lg">
                <div class="container mx-auto px-4">

                  <div class="max-w-sm w-full lg:max-w-full lg:flex">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('img/mccu.jpg')" title="Woman holding a mug">
                    </div>
                    <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                      <div class="mb-8">
                        <p class="text-sm text-gray-600 flex items-center">
                          <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                          </svg>
                          Members only
                        </p>
                        <div class="text-gray-900 font-bold text-xl mb-2">
                          <button type="button" onclick="ventana()" class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</button>
                        </div>
                        <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
                      </div>
                      <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full mr-4" src="{{ asset('img/mccu.jpg') }}" alt="Avatar of Jonathan Reinink">
                        <div class="text-sm">
                          <p class="text-gray-900 leading-none">Jonathan Reinink</p>
                          <p class="text-gray-600">Aug 18</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="my-8 max-w-sm w-full lg:max-w-full lg:flex">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('img/mccu.jpg')" title="Woman holding a mug">
                    </div>
                    <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                      <div class="mb-8">
                        <p class="text-sm text-gray-600 flex items-center">
                          <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                          </svg>
                          Members only
                        </p>
                        <div class="text-gray-900 font-bold text-xl mb-2">
                          <button type="button" onclick="ventana()" class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</button>
                        </div>
                        <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
                        <div class="flex items-center">
                          <img class="w-10 h-10 rounded-full mr-4" src="{{ asset('img/mccu.jpg') }}" alt="Avatar of Jonathan Reinink">
                          <div class="text-sm">
                            <p class="text-gray-900 leading-none">Jonathan Reinink</p>
                            <p class="text-gray-600">Aug 18</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="my-8 max-w-sm w-full lg:max-w-full lg:flex">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('img/mccu.jpg')" title="Woman holding a mug"></div>
                    <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                      <div class="mb-8">
                        <p class="text-sm text-gray-600 flex items-center">
                          <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                          </svg>
                          Members only
                        </p>
                        <div class="text-gray-900 font-bold text-xl mb-2">
                          <button type="button" onclick="ventana()" class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</button>
                        </div>
                        <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
                      </div>
                      <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full mr-4" src="{{ asset('img/mccu.jpg') }}" alt="Avatar of Jonathan Reinink">
                        <div class="text-sm">
                          <p class="text-gray-900 leading-none">Jonathan Reinink</p>
                          <p class="text-gray-600">Aug 18</p>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="my-8 max-w-sm w-full lg:max-w-full lg:flex">
                    <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('img/mccu.jpg')" title="Woman holding a mug"></div>
                    <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                      <div class="mb-8">
                        <p class="text-sm text-gray-600 flex items-center">
                          <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                          </svg>
                          Members only
                        </p>
                        <div class="text-gray-900 font-bold text-xl mb-2">
                          <button type="button" onclick="ventana()" class="text-gray-900 font-bold text-xl mb-2">Can coffee make you a better developer?</button>
                        </div>
                        <p class="text-gray-700 text-base">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et perferendis eaque, exercitationem praesentium nihil.</p>
                      </div>
                      <div class="flex items-center">
                        <img class="w-10 h-10 rounded-full mr-4" src="{{ asset('img/mccu.jpg') }}" alt="Avatar of Jonathan Reinink">
                        <div class="text-sm">
                          <p class="text-gray-900 leading-none">Jonathan Reinink</p>
                          <p class="text-gray-600">Aug 18</p>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                
              </div>
            </div>
            <!-- /End replace -->
          </div>
        </main>

        @livewireScripts
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('js/invitado.js') }}"></script>
    </body>
</html>
