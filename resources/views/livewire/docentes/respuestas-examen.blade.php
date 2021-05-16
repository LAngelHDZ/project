<div>
    {{-- In work, do what you enjoy. --}}

    @if(count($listRespuestas) == 0)
        <p>Sin respuestas agregadas</p>
    @else
        @foreach($listRespuestas as $item)
            <div class="flex">
                <input type="checkbox" name="{{ $item->idRespuesta }}" id="{{ $item->idRespuesta }}" disabled >
                <div class="">
                    <p class="pl-5 -mt-1 font-sans text-gray-700">{{ $item->respuesta }}</p>
                </div>
                @if($item->rcorrecta == 1 )
                <svg class="w-6 h-6 pl-2 -mt-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                @endif
            </div>
        @endforeach
    @endif
</div>
