<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="container px-10 mb-5 rounded-lg @if($puntosObtenidos < ($totalPuntos/2) ) bg-red-300 @else bg-green-300 @endif ">
        <p class="p-6 text-xl">Puntuacion Obtenida: {{ $puntosObtenidos ?? 0 }} / {{ $totalPuntos }}</p>
    </div>

    <div class="container px-10 mb-5">
        @if(count($resultados) == 0)
            <div class="shadow rounded-lg bg-white p-5 mt-2 flex">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="ml-3">Puede ser que el profesor no haya calificado el examen aun... </p>
            </div>
        @else
            @foreach($resultados as $item)
            <div class="shadow rounded-lg @if($item->rcorrecta == 0) bg-red-200 @elseif($item->rcorrecta == 1) bg-green-200 @else bg-white @endif p-5 mt-2">
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
                            <p class="">Tus Respuestas</p>
                            @php $res = $this->goArray($item->respuestas) @endphp
                            @for($i = 0; $i < count($res); $i++)
                                <p class="ml-10 font-sans text-lg text-blue-600"> <input type="checkbox" name="" id="" disabled checked> {{ $this->getRespuestas($res[$i]) }}</p>
                            @endfor
                        </div>
                        <div class="">
                            <p class="">Respuesta Correcta</p>
                            @php $resDocente = $this->getRespuestasDocente( $item->pregunta_id ) @endphp
                            @foreach( $resDocente as $response) 
                            <p class="ml-10 font-sans text-lg text-blue-600"><input type="checkbox" name="" id="" disabled checked> {{ $response->respuesta }}</p>  
                            @endforeach
                        </div>
                    </div>
                @else
                <p class="ml-10 font-sans text-lg text-blue-600">Respuesta: {{ $item->respuestas  }}</p>
                @endif
            </div>
            @endforeach
        @endif
    </div>
</div>
