<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Datos Socioeconomicos') }}</h2>
  </x-slot>

  <div class="container mx-auto px-4 mt-4">
    
    <a href="{{ url()->previous() }}" class="flex flex-items-start w-24 text-blue-600 hover:text-blue-800">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      <p class="mx-2">Volver</p>
    </a>

    @if (session()->has('message'))
      <div class="w-full mt-5 h-12 flex justify-center bg-green-300 text-base rounded-lg border-green-200 shadow-2xl">
        <div class="space-y-1 text-center">
          <p></p>
          <p></p>
          <p class="align-middle">{{ session('message') }}</p>
        </div>
      </div>
    @endif
    
    <h2 class="font-sans text-2xl text-gray-800 m-4">
      {{ __('Curso: ') }} {{ $curso->nombreCurso }}
    </h2>

    <div class="shadow rounded-lg bg-white px-10">
      <div class="grid col-span-1 md:flex items-center mt-5 justify-center py-5">
        <div class="md:mr-4">
          <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=448&q=80" alt="Sunset in the mountains" 
            class="rounded-md p-5 max-w-xs">
        </div>
        <div class="md:border-l-2 pl-4 p-2 col-span-2 text-justify md:w-1/2 mt-10 md:mt-0">
          <h1 class="font-sans text-2xl font-bold text-blue-700">Curso: {{ $curso->nombreCurso }} </h1>
          <h2 class="font-sans text-xl font-bold">Descripcion:</h2>
          <p class="font-sans text-base">{{ $curso->descripcion }}</p>
          <h2 class="font-sans text-xl font-bold">Periodo: </h2>
          <p class="font-sans text-base">Periodo: {{ $periodo->periodo.' '.$periodo->year }}</p>
        </div>
      </div>
    </div>

    <h2 class="font-sans text-2xl text-gray-800 mx-4 my-2">
      {{ __('Acciones') }}
    </h2>

    <div class="flex justify-center rounded shadow py-2 px-10 bg-white">
      <a href="{{ route('calificarActividades', $curso->idCurso) }}" class="border-2 border-transparent bg-blue-500 ml-3 py-2 px-4 font-bold text-white rounded transition-all hover:border-blue-500 hover:bg-transparent hover:text-blue-500">
        Calificar Actividades
      </a>
      <a href="{{ route('calificarUnidades', $curso->idCurso) }}" class="border-2 border-transparent bg-blue-500 ml-3 py-2 px-4 font-bold text-white rounded transition-all hover:border-purple-500 hover:bg-transparent hover:text-purple-500">
        Calificar Unidad
      </a>
      <a href="{{ route('calificarCurso', $curso->idCurso) }}" class="border-2 border-transparent bg-blue-500 ml-3 py-2 px-4 font-bold text-white rounded transition-all hover:border-green-500 hover:bg-transparent hover:text-green-500">
        Evaluacion Final
      </a>
      <a href="{{ route('createExamen', $curso->idCurso) }}" class="border-2 border-transparent bg-blue-500 ml-3 py-2 px-4 font-bold text-white rounded transition-all hover:border-green-500 hover:bg-transparent hover:text-green-500">
        Crear Examen
      </a>
    </div>

    <h2 class="font-sans text-2xl text-gray-800 m-4">
      {{ __('Contenido del curso') }}
    </h2>
    
    <div class="form-task px-8">
      @foreach($materia as $item)
        <livewire:docentes.temas-curso :idMateria="$item->idMateria" :idCurso="$curso->idCurso" />
      @endforeach
    </div>
    
    <h2 class="font-sans text-2xl text-gray-800 m-4">
      {{ __('Alumnos Inscritos al Curso') }}
    </h2>

    <div class="px-8">
      <livewire:docentes.alumnos-inscritos :idCurso="$curso->idCurso" />
    </div>

    <h2 class="font-sans text-2xl text-gray-800 m-4">
      {{ __('Estadisticas del curso') }}
    </h2>

    <div class="px-8">
      <livewire:docentes.estadisticas-grupo :idCurso="$curso->idCurso" />
    </div>

  </div>

</x-app-layout>