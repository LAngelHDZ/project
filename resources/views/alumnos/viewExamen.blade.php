<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="container mx-auto px-4 mt-5">
        <a href="{{ url()->previous() }}" class="flex flex-items-start w-24 text-blue-600 hover:text-blue-800">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <p class="mx-2">Volver</p>
        </a>
    </div>

    <div class="mt-5 container">
        <h4 class="text-center font-sans text-center text-blue-500 text-2xl font-bold">Recomendaciones:</h4>

        <p class="font-sans text-base text-gray-500 px-10 mt-2">
            1.- Las preguntas se mostraran una la vez, no podras avanzar a la siguinte pregunta si no has contestado la pregunta actual. 
        </p>
        <p class="font-sans text-base text-gray-500 px-10 mt-2">
            2.- Si cierras, o se cierra la pagina donde estas haciendo el examen, no se guardara ninguna de las pregutas que ya hayas contestado.
        </p>
        <p class="font-sans text-base text-gray-500 px-10 mt-2">
            3.- Contesta todas las preguntas, al final selecciona finalizar examen para que tus respuestas sean eviadas.
        </p>
    </div>

    <div class="text-center mt-5">
        @php 
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
        @endphp

        @if( $fecha >= $examen->fecha_apertura && $fecha <= $examen->fechalimite )
            @if( $hora > $examen->hora_apertura && $hora < $examen->horalimite )        
            <a href="{{ route('startExamen', $examen->idExamen) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Comenzar Examen
            </a>
            @endif
        @else
        <p class="animate-pulse"><small class="text-sm text-gray-600">Solo puedes realizar el examen en la fecha y hora correspondiente</small></p>
        <button type="button" disabled class="cursor-wait disabled:opacity-50 bg-blue-500 text-white font-bold py-2 px-4 rounded" disabled>
            Comenzar Examen
        </button>
        @endif
    </div>

</x-app-layout>