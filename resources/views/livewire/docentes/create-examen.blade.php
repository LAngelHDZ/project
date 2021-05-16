<div >
    {{-- Be like water. --}}

    <div class="shadow rounded-lg bg-white my-4">
        <div class="p-4 my-5">
            <h4 class="font-sans text-2xl text-gray-600">Crear Examen</h4>
            <form action="" method="post" class="mt-3" wire:submit.prevent="storeExamen">
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Titulo</label>
                        <input type="text" wire:model="titulo" name="" id="" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                        maxlength="100">
                        @error('titulo')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Descripcion</label>
                        <input type="text" wire:model="descripcion" name="" id="" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                        maxlength="200">
                        @error('descripcion')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Fecha Apertura</label>
                        <input type="date" wire:model="fechaApertura" name="" id="" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                        min="@php echo date('Y-m-d'); @endphp">
                        @error('fechaApertura')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Hora Apertura</label>
                        <input type="time" wire:model="horaApertura" name="" id="" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors">
                        @error('horaApertura')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Fecha Limite</label>
                        <input type="date" wire:model="fechaLimite" name="" id="" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                        min="@php echo date('Y-m-d'); @endphp">
                        @error('fechaLimite')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="px-2 w-1/2">
                        <label class="font-bold text-sm mb-2 ml-1">Hora Limite</label>
                        <input type="time" wire:model="horaLimite" name="" id="" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors">
                        @error('horaLimite')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>    
                <div>
                    <button type="submit" class="block w-full max-w-xs mx-auto bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-3 font-semibold">
                        Agregar
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if(count($listExamen) == 0)
    @else
        <h4 class="text-xl font-sans text-black">Lista de Examenes </h4>
        @foreach($listExamen as $item )
        <div class="show rounded-lg bg-white my-4 p-4 mt-3">
            <h4 class="text-xl font-sans text-gray-600">{{ $item->titulo }}</h4>
            <p class="text-lg text-gray-500">{{ $item->descripcion }}</p>
            <p class="text-lg text-gray-500">Horario de Apertura: {{ $item->fecha_apertura.' - '.$item->hora_apertura  }}</p>
            <p class="text-lg text-gray-500">Horario de Cierre: {{ $item->fechalimite.' - '.$item->horalimite  }}</p>

            <div class="w-full flex flex-col sm:flex-row">
                <a href="{{ route('createPreguntasExamen', $item->idExamen ) }}" class="bg-green-600 font-semibold text-white p-2 w-44 rounded-sm hover:bg-green-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <p class="-mt-6 text-center">Preguntas</p> 
                </a>
                <button wire:click="showModal( {{ $item->idExamen }}, '{{$item->titulo }}', '{{$item->descripcion }}', '{{$item->fecha_apertura }}', '{{$item->hora_apertura}}','{{$item->fechalimite }}', '{{$item->horalimite }}' )" 
                class="bg-blue-600 font-semibold text-white p-2 w-44 rounded-sm hover:bg-blue-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    <p class="-mt-6">Editar</p>
                </button>
            </div>
        </div>
        @endforeach
    @endif



    <dialog id="myModal" class="w-11/12 md:w-1/2 p-5  bg-white rounded-md">
        
        <div class="flex flex-col w-full h-auto ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Modificar Examen
                </div>
                <div onclick="document.getElementById('myModal').close()" class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </div>
                <!--Header End-->
            </div>
            
            <!-- Modal Content-->
            <div class="w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-gray-500">
                <form action="" method="post" wire:submit.prevent="updateExamen">
                    <div class="flex items-end">
                        <div class="px-2 w-1/2">
                            <div>
                                <label for="tituloEdit" class="">Titulo</label>
                                <input type="text" name="tituloEdit" id="tituloEdit" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                                wire:model.defer="tituloEdit">
                            </div>
                        </div>
                        <div class="px-2 mt-3 w-1/2">
                            <div class="">
                                <label for="descripcionEdit">Descripcion</label>
                                <input type="text" name="descripcionEdit" id="descripcionEdit" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                                wire:model.defer="descripcionEdit"/>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-end">
                        <div class="px-2 w-1/4">
                            <div>
                                <label for="fechaPaerturaEdit" class="">Fceha Apertura</label>
                                <input type="date" name="fechaPaerturaEdit" id="fechaPaerturaEdit" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                                wire:model.defer="fechaAperturaEdit" min="@php echo date('Y-m-d'); @endphp">
                            </div>
                        </div>
                        <div class="px-2 mt-3 w-1/4">
                            <div class="">
                                <label for="horaAperturaEdit">Hora Apertura</label>
                                <input type="time" name="horaAperturaEdit" id="horaAperturaEdit" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                                wire:model.defer="horaAperturaEdit" />
                            </div>
                        </div>
                        <div class="px-2 mt-3 w-1/4">
                            <div class="">
                                <label for="fechaLimiteEdit">Fecha Cierre</label>
                                <input type="date" name="fechaLimiteEdit" id="fechaLimiteEdit" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                                wire:model.defer="fechaLimiteEdit" min="@php echo date('Y-m-d'); @endphp"/>
                            </div>
                        </div>
                        <div class="px-2 mt-3 w-1/4">
                            <div class="">
                                <label for="horaLimiteEdit">Hora de Cierre</label>
                                <input type="time" name="horaLimiteEdit" id="horaLimiteEdit" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                                wire:model.defer="horaLimiteEdit"/>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="text-center mt-5 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Guardar Cambios</button>
                    </div>
                </form>
            </div>
            <!-- End of Modal Content-->   
        </div>
    </dialog>

</div>

<style>
    dialog[open] {
        animation: appear .15s cubic-bezier(0, 1.8, 1, 1.8);
    }
    
    dialog::backdrop {
        background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
        backdrop-filter: blur(3px);
    }
    
    @keyframes appear {
        from {
          opacity: 0;
          transform: translateX(-3rem);
        }
      
        to {
          opacity: 1;
          transform: translateX(0);
        }
    }
</style>


<script>
    window.addEventListener('modalExamen', event => {
        //alert('Name updated to: ' + event.detail.idAlumnoActividad);
        document.getElementById('myModal').showModal()
    })
    
    // evento dispara en el navegador genera problemas 
    window.addEventListener('closeModalExamen',event => {
        document.getElementById('myModal').close()
        //swal("Good job!", "Se agrego la calificacion a la actividad!", "success");
    })
</script>