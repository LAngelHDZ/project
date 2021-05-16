<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="container px-10 mb-5 rounded-lg @if($puntosObtenidos < ($totalPuntos/2) ) bg-red-300 @else bg-green-300 @endif ">
        <p class="p-6 text-xl">Puntuacion Obtenida: {{ $puntosObtenidos ?? 0 }} / {{ $totalPuntos }}</p>
    </div>

    <div class="container px-10 mb-5">
        @if(count($resultados) == 0)
        <div class="shadow rounded-lg bg-white p-5 mt-2">
            <h1 class="font-sans text-lg">El alumno no a presentado el examen</h1>
        </div>
        @else
            @foreach($resultados as $item)
            <div class="shadow rounded-lg bg-white p-5 mt-2">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="font-sans font-light text-xl">{{ $loop->iteration }} .-  {{ $item->pregunta }}</p>
                    </div>
                    <div class="flex justify-end">
                        <p class="font-sans font-light text-xl">Puntos {{ $item->puntos }}</p>
                    </div>
                </div>
                @if($item->tipo == 2 )
                    <div class="grid grid-cols-2 grap-4 mt-2">
                        <div class="">
                            <p class="">Respuesta del Alumno</p>
                            @php $res = $this->goArray($item->respuestas) @endphp
                            @for($i = 0; $i < count($res); $i++)
                                <p class="ml-10 font-sans text-lg text-blue-600"> <input type="checkbox" name="" id="" disabled checked> {{ $this->getRespuestas($res[$i]) }}</p>
                            @endfor
                        </div>
                        <div class="">
                            <p class="">Respuesta del Docente</p>
                            @php $resDocente = $this->getRespuestasDocente( $item->pregunta_id ) @endphp
                            @foreach( $resDocente as $response) 
                            <p class="ml-10 font-sans text-lg text-blue-600"><input type="checkbox" name="" id="" disabled checked> {{ $response->respuesta }}</p>  
                            @endforeach
                        </div>
                    </div>
                @else
                <p class="ml-10 font-sans text-lg text-blue-600">Respuesta: {{ $item->respuestas  }}</p>
                @endif
                <div class="mt-5">
                    <button type="button" class="focus:outline-none text-white text-sm py-2 px-2 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg"
                    wire:click="correctAnswer( {{ $item->idExamenAlumno }} ) ">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </button>
                    <button type="button" class="focus:outline-none text-white text-sm py-2 px-2 rounded-md bg-red-500 hover:bg-red-600 hover:shadow-lg"
                    wire:click="incorrectAnswer({{ $item->idExamenAlumno }}) ">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    document.addEventListener('showMensaje',event => {
        //document.getElementById('myModal').close()
        swal("Good job!", "Respuesta Calificada!", "success");
    })
</script>
