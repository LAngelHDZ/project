<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Calificacion de actividades del curso') }}</h2>
    </x-slot>

    <div class="container mx-auto px-4 mt-4">

        <a href="{{ url()->previous() }}" class="flex flex-items-start w-24 text-blue-600 hover:text-blue-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <p class="mx-2">Volver</p>
        </a>

        <livewire:docentes.calificar-unidades :cursoId="$curso" />
    </div>
    
</x-app-layout>