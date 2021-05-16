<div>
    {{-- The whole world belongs to you --}}

    @if(empty($temas))
        <h4 class="text-xl mx-3 text-blue-800">No hay temas agregados</h4>
    @else
        @foreach($temas as $item)
            <div class="flex justify-start content-center">
                @if($item->tipo == 1 )
                    <div class="mt-5">
                        <h4 class="text-xl mx-3 text-blue-800">{{ $item->indice.' .- '.$item->nombreTema  }} </h4>
                    </div>
                    <div class="-mt-1">
                        @if($item->cantAct == 1 )
                        <a href="{{ route('viewActividadDocente', $item->idActividadTemas ) }}" class="ml-4 " title="Ver Actividad">
                            <svg class="w-6 h-6 text-indigo-600 hover:text-indigo-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        @else
                        <a href="{{ route('docenteaddActividad',['curso'=> $idCurso,'tema' => $item->idTema]) }}" class="ml-4" title="Agregar Actividad">
                            <svg class="w-6 h-6 text-indigo-600 hover:text-indigo-900" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </a>
                        @endif
                    </div>
                @elseif($item->tipo == 2 )
                    <div class="flex justify-start content-center">
                        <div class="">
                            <p class="mx-8 text-sm text-gray-500">{{ $item->indice.' .- '.$item->nombreTema }}</p>
                        </div>
                        <div class="-mt-5">
                            @if($item->cantAct == 1)
                            <a href="{{ route('viewActividadDocente', $item->idActividadTemas ) }}" class="ml-2 text-xs text-gray-400 hover:text-gray-600" title="Ver Actividad">
                                <svg class="w-4 h-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </a>
                            @else
                            <a href="{{ route('docenteaddActividad',['curso'=> $idCurso,'tema' => $item->idTema]) }}" class="ml-2 text-xs text-gray-400 hover:text-gray-600" title="Agregar Actividad">
                                <svg class="w-4 h-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        @endforeach
    @endif
</div>
