<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Datos Socioeconomicos') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <h4 class="font-sans text-gray-600 font-bold text-2xl my-2">Todos los Cursos</h4>
        <livewire:alumnos.alumnos-all-cursos />
    </div>

</x-app-layout>