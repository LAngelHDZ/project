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
        <livewire:alumnos.alumnos-cursos-insc />
        <!--<div class="max-w-2xl mx-auto">
            <ul class="flex border-b">
                <li class="-mb-px mr-1">
                    <a class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold" href="#">Cusos Actuales</a>
                </li>
                <li class="mr-1">
                    <a class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" href="#">Todo los Cursos</a>
                </li>
            </ul>
        </div>-->
    </div>


</x-app-layout>