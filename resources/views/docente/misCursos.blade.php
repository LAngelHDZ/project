<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Datos Socioeconomicos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <h2 class="font-sans text-2xl text-gray-800 mx-4 my-4">
            {{ __('Mis Cursos') }}
        </h2>

        <div class="mt-5">
            <livewire:docentes.miscursos /> 
        </div>
    </div>

</x-app-layout>