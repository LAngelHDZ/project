<div>
    @if(empty($temas))
        <h4 class="text-xl mx-3 text-blue-800">No hay temas agregados</h4>
    @else
        @foreach($temas as $item)
            @if($item->tipo == 1 )
                <h4 class="text-xl mx-3 text-blue-800">{{ $item->indice.' .- '.$item->nombreTema  }}</h4>
            @elseif($item->tipo == 2 )
                <p class="mx-6 text-sm text-gray-500">{{ $item->indice.' .- '.$item->nombreTema }}</p>
            @endif
        @endforeach
    @endif
</div>
