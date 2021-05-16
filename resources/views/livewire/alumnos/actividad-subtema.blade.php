<div>
    {{-- In work, do what you enjoy. --}}
    @if(count($actividadSubtemas) == 0)
        <p class="font-sans text-base text-black text-center">No hay Actividad Agregada </p>
    @else
        @foreach($actividadSubtema as $item)
            <div class="w-11/12 bg-gray-50 rounded-lg border-dashed shadow-md mt-1 ml-15 px-15">
                <div class="flex">
                    <div class="flex-none h-12 content-center">
                        <i class="far fa-square my-4 mr-5 transform scale-150"></i>
                        <!--<i class="fas fa-chalkboard fa-fw mr-3"></i>-->
                    </div>
                    <div class="flex-grow h-12">
                        <h1 class="font-sans text-base text-black text-left">{{ $item->subindice.'.- '.$item->nombre_subindice }}</h1>
                        <h3 class="font-sans text-sm text-gray-800 text-right">{{ $item->nombreActividad.' '.$item->fechainicio.' - '.$item->fechalimite }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
