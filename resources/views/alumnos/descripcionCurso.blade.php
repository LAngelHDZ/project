<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Datos Socioeconomicos') }}
    </h2>
  </x-slot>

  <livewire:solicitud-inscripcion-alumno :curso="$curso" :solicitudes="$solicitud" :cursoId="$cursoId" ></livewire:solicitud-inscripcion-alumno>

</x-app-layout>
