<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    @if($mensaje)
    <div class="py-3 px-5 mb-4 bg-blue-100 text-blue-900 text-sm rounded-md border border-blue-200" role="alert">
        MENSAJE! <strong>{{ $mensaje }}</strong> <a href="{{ route('dashboard') }}">Click aqui</a>
    </div>
    @endif

    @foreach( $examen as $item )
    <div class="shadow rounded-lg bg-white p-8 mt-5">
        <div class="">
            <h4 class="text-blue-600 text-2xl">{{ $item->titulo }}</h4>
            <p class="text-lg text-gray-700">{{ $item->descripcion }}</p>
        </div>
        <div class="flex">
            <div class="w-1/2">
                <p class="text-lg text-gray-700">Fecha de Cierre: {{ $item->fechalimite }}</p>
            </div>
            <div class="w-1/2">
                <p class="text-lg text-gray-700">Hora de Cierre: {{ $item->horalimite }}</p>
            </div>
        </div>
    </div>
    @endforeach

    @if($showExamen && count($listPreguntas) > 0 )

    <div class="shadow rounded-lg bg-white p-8 mt-5">
        <div class="flex">
            <div class="w-2/3 px-2">
                <p class="font-sans text-black">{{ $iteracion + 1 }}.- {{ $listPreguntas[$iteracion]->pregunta }} </p>
            </div>
            <div class="w-1/3 flex justify-end">
                <p class="font-sans text-green-500">Valor de la Pregunta: {{ $listPreguntas[$iteracion]->puntos  }}</p>
            </div>
        </div>
        @if($listPreguntas[$iteracion]->tipo == 2)
        <div class="pl-10 mt-3">
            @foreach( $this->getRespuestasPregunta($listPreguntas[$iteracion]->idPregunta ) as $list )
            <div class="flex mt-2">
                <input type="hidden" name="pregunta" wire:model="">
                <input type="checkbox" name="respuesta" id="respuesta"  value="{{ $list->idRespuesta }}" wire:model="respuestaAlumno">
                <div class="">
                    <p class="pl-5 -mt-1 font-sans text-gray-700">{{ $list->respuesta }}</p>
                </div>
            </div>
            @endforeach

            @error('respuestaAlumno')
            <small>
                <span class="text-red-600">{{ $message }}</span>
            </small>
            @enderror
        </div>
        @elseif($listPreguntas[$iteracion]->tipo == 1)
        <div class="pl-10 mt-3">
            <div class="flex mt-2">
                <input type="text" name="respuestatext" placeholder="Escribe tu Respuesta" wire:model="respuestaText" 
                class="bg-white h-10 w-full px-5 pr-10 rounded-full text-sm border-2 border-blue-200 focus:outline-none">
            </div>
            @error('respuestaText')
            <small>
                <span class="text-red-600">{{ $message }}</span>
            </small>
            @enderror
        </div>
        @endif

        @if($iteracion == count($listPreguntas) - 1)
        <div class="flex justify-end mt-5">
            @if($bloqueo)
            <button class="bg-gray-100 p-3 rounded-lg hover:bg-gray-200 focus:outline-none" disabled>
                Finalizar Examen
            </button>
            @else
            <button class="bg-gray-100 p-3 rounded-lg hover:bg-gray-200 focus:outline-none" wire:click="saveAndNext({{ $listPreguntas[$iteracion]->idPregunta }},{{ $listPreguntas[$iteracion]->tipo }}, {{ 'true' }} )">
                Finalizar Examen
            </button>
            @endif
        </div>
        @else
        <div class="flex justify-end mt-5">
            <button class="bg-gray-100 p-3 rounded-lg hover:bg-gray-200 focus:outline-none" wire:click="saveAndNext({{ $listPreguntas[$iteracion]->idPregunta }},{{ $listPreguntas[$iteracion]->tipo }}, {{ 'false' }} )">
                Guardar y Siguiente
            </button>
        </div>
        @endif
    </div>
    @endif

    {{-- @foreach($listPreguntas as $item)
    <div class="shadow rounded-lg bg-white p-8 mt-5">
        <div class="flex">
            <div class="w-2/3 px-2">
                <p class="font-sans text-black">{{ $loop->iteration }}.- {{ $item->pregunta }} </p>
            </div>
            <div class="w-1/3 flex justify-end">
                <p class="font-sans text-green-500">Valor de la Pregunta: {{ $item->puntos  }}</p>
            </div>
        </div>
        @if($item->tipo == 2 )
        <div class="pl-10 mt-3">
            @foreach( $this->getRespuestasPregunta($item->idPregunta ) as $list )
            <div class="flex mt-2">
                <input type="checkbox" name="respuesta" id="respuesta" >
                <div class="">
                    <p class="pl-5 -mt-1 font-sans text-gray-700">{{ $list->respuesta }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="pl-10 mt-3">
            <div class="flex mt-2">
                <input type="text" name="respuestatext{{$item->idPregunta}}" placeholder="Escribe tu Respuesta" 
                class="bg-white h-10 w-full px-5 pr-10 rounded-full text-sm border-2 border-blue-200 focus:outline-none">
            </div>
        </div>
        @endif

        <div class="flex justify-end">
            <button class="">
                Guardar y Siguiente
            </button>
        </div>

    </div>
    @endforeach --}}
</div>

