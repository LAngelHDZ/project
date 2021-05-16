<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('tareas cursos') }}</h2>
  </x-slot>
    
  <div class="container mx-auto px-4 mt-5">
    <a href="{{ url()->previous() }}" class="flex justify-start w-24 text-blue-600 hover:text-blue-800">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      <p class="mx-2">Volver</p>  
    </a>

    <div class="shadow rounded-lg bg-white">
      <div class="grid col-span-1 md:flex items-center mt-5 justify-center py-5">
        <div class="mr-14">
          <!--<img class="md:w-40" src="https://i.imgur.com/HvlloWd.png" alt="Logo">-->
        </div>
        <div class="md:mr-4">
          <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=448&q=80" alt="Sunset in the mountains" 
            class="rounded-md p-5 max-w-xs">
        </div>
        <div class="md:border-l-2 pl-4 p-2 col-span-2 text-justify md:w-1/2 mt-10 md:mt-0">
          @foreach($curso as $item)
            <h1 class="font-sans text-2xl font-bold text-blue-700">Curso: {{ $item->nombreCurso }} </h1>
            <h2 class="font-sans text-xl font-bold">Descripcion:</h2>
            <p class="font-sans text-base">{{ $item->descripcion }}</p>
            <h2 class="font-sans text-xl font-bold">Periodo: </h2>
            <p class="font-sans text-base">{{ $item->periodo.' - '.$item->year  }}</p>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  <div class="container mx-auto px-4 mt-5">
    <div class="flex flex-col">
      <livewire:alumnos.actividad-tema :cursoid="$idCurso" />
    </div>
  </div>
  
</x-app-layout>