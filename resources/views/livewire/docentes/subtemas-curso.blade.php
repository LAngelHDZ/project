<div>
    {{-- The best athlete wants his opponent at his best. --}}

    @foreach($subtemas as $item)
        <div class="flex justify-start content-center">
            <div class="">
                <p class="mx-8 text-sm text-gray-500">{{ $item->subindice.' .- '.$item->nombre_subindice }}</p>
            </div>
            <div class="-mt-5">
                <a href="#" class="ml-2 text-xs text-gray-400 hover:text-gray-600" title="Agregar Actividad">
                    <svg class="w-4 h-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </a>
                
            </div>
        </div>
    @endforeach
</div>
