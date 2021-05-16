<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}

    <div class="shadow rounded-lg bg-white my-4">
        <div class="p-4 my-5">
            <h4 class="font-sans text-2xl text-gray-600">Agregar Preguntas</h4>

            <form action="" method="post" wire:submit.prevent="storePreguntas">
                <div class="mb-3 -mx-2 flex items-end">
                    <div class="px-2 w-1/3">
                        <label class="font-bold text-sm mb-2 ml-1">Pregunta</label>
                        <input type="text" wire:model.defer="pregunta" name="pregunta" id="pregunta" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                        maxlength="100">
                        @error('pregunta')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="px-2 w-1/3">
                        <label class="font-bold text-sm mb-2 ml-1">Puntos de Pregunta</label>
                        <input type="number" wire:model.defer="puntosPregunta" name="puntosPregunta" id="puntosPregunta" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                        min="0" max="100" step="1">
                        @error('puntosPregunta')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="px-2 w-1/3">
                        <label class="font-bold text-sm mb-2 ml-1">Tipo de Pregunta</label>
                        <select name="tipoPregunta" id="tipoPregunta" wire:model.defer="tipoPregunta" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors">
                            <option selected>Seleccione</option>
                            <option value="1">Texto</option>
                            <option value="2">Opcion</option>
                        </select>
                        @error('tipoPregunta')
                            <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <button class="bg-green-600 font-semibold text-white p-2 w-44 rounded-sm hover:bg-green-700 focus:outline-none focus:ring shadow-lg hover:shadow-none transition-all duration-300 m-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <p class="-mt-6">Agregar</p>
                    </button>
                </div>
            </form>
        </div>
    </div>
     
    @foreach($listPreguntas as $item)
   
    <div class="shadow rounded-lg bg-white my-4">
        <div class="p-5">
            <div class="flex">
                <div class="px-2">
                    <p class="font-sans text-black">{{ $loop->iteration }}.- {{ $item->pregunta }} </p>
                </div>
            </div>
            @if($item->tipo == 2 )
            <div class="pl-10">
                
                {{-- $this->listRespuestas = $this->getRespuestas($item->idPregunta ) --}}
                @foreach( $this->getRespuestas($item->idPregunta ) as $list )
                <div class="flex">
                    <button type="button" class="pr-2 -mt-2" wire:click="showModalEditRespuestas( {{ $list->idRespuesta }}, '{{$list->respuesta}}', {{$list->rcorrecta}}, {{$list->pregunta_id}} )">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </button>
                    <input type="checkbox" name="{{ $list->idRespuesta }}" id="{{ $list->idRespuesta }}" disabled >
                    <div class="">
                        <p class="pl-5 -mt-1 font-sans text-gray-700">{{ $list->respuesta }}</p>
                    </div>
                    @if($list->rcorrecta == 1 )
                    <svg class="w-6 h-6 pl-2 -mt-1 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    @endif
                </div>
                @endforeach
                <!--<livewire:docentes.respuestas-examen :preguntaId="$item->idPregunta" />-->
            </div>
            @endif
            <P class="text-gray-500 mt-4">Valor de la Pregunta: {{ $item->puntos }}</P>

            <div class="flex">
                @if($item->tipo == 2 )
                <div class="px-2 mt-5">
                    <button class="inline-flex items-center" wire:click="showModal( '{{ $item->idPregunta }}' )">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Agregar Respuesta</span>
                    </button>
                </div>
                @endif
                <div class="px-2 mt-5">
                    <button class="inline-flex items-center" wire:click="showModalEditPreguntas( '{{ $item->idPregunta }}', '{{ $item->pregunta }}', {{ $item->puntos  }}, {{ $item->tipo }} )">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        <span>Editar Preguntas</span>
                    </button>
                </div>
            </div>
            
        </div>
    </div>
        @php
            $idAnterior = $item->idPregunta  
        @endphp
    @endforeach

    <dialog id="myModal" class="w-11/12 md:w-1/2 p-5  bg-white rounded-md">
        
        <div class="flex flex-col w-full h-auto ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Agregar Respuesta
                </div>
                <div onclick="document.getElementById('myModal').close()" class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </div>
                <!--Header End-->
            </div>
            
            <!-- Modal Content-->
            <div class="w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-gray-500">
                <form action="" method="post" wire:submit.prevent="storeRespuestas">
                    <div class="items-end">
                        <div class="px-2">
                            <div>
                                <label for="respuesta" class="block font-medium text-gray-700">Respuesta</label>
                                <input type="text" name="respuesta" id="respuesta" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                                wire:model.defer="respuesta">
                            </div>
                        </div>
                        <div class="px-2 mt-3">
                            <div class="">
                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="toggle" id="toggle" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                    wire:model.defer="iscorrect"/>
                                    <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>
                                <label for="toggle" class="text-xs text-gray-700">Marcar esta respuesta como correcta.</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="text-center mt-5 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Guardar</button>
                    </div>
                </form>
            </div>
            <!-- End of Modal Content-->   
        </div>
    </dialog>

    <dialog id="modalPreguntas" class="w-11/12 md:w-1/2 p-5  bg-white rounded-md">
        
        <div class="flex flex-col w-full h-auto ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Editar Pregunta
                </div>
                <div onclick="document.getElementById('modalPreguntas').close()" class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </div>
                <!--Header End-->
            </div>
            
            <!-- Modal Content-->
            <div class="w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-gray-500">
                <form action="" method="post" wire:submit.prevent="updatePreguntas">
                    <div class="flex items-end">
                        <div class="px-2 w-1/2">
                            <div>
                                <label for="preguntaEdit" class="block font-medium text-gray-700">Pregunta</label>
                                <input type="text" wire:model.defer="preguntaEdit" name="preguntaEdit" id="preguntaEdit" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                                maxlength="100">
                                <input type="hidden" name="" wire:model.defer="idPreguntaEdit">
                            </div>
                        </div>
                        <div class="px-2 w-1/2">
                            <div>
                                <label for="puntosPreguntaEdit" class="block font-medium text-gray-700">Puntos Pregunta</label>
                                <input type="number" wire:model.defer="puntosPreguntaEdit" name="puntosPreguntaEdit" id="puntosPreguntaEdit" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                                min="0" max="100" step="1">
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

    <dialog id="modalRespuestasEdit" class="w-11/12 md:w-1/2 p-5  bg-white rounded-md">
        
        <div class="flex flex-col w-full h-auto ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Editar Pregunta
                </div>
                <div onclick="document.getElementById('modalRespuestasEdit').close()" class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </div>
                <!--Header End-->
            </div>
            
            <!-- Modal Content-->
            <div class="w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-gray-500">
                <form action="" method="post" wire:submit.prevent="updateRespuesta">
                    <div class="flex items-end">
                        <div class="px-2 w-1/2">
                            <div>
                                <label for="respuestaEdit" class="block font-medium text-gray-700">Respuesta</label>
                                <input type="text" wire:model.defer="respuestaEdit" name="respuestaEdit" id="respuestaEdit" class="w-full px-3 py-2 mb-1 border-2 border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors"
                                maxlength="100">
                                <input type="hidden" name="" wire:model.defer="idRespuestaEdit">
                                <input type="hidden" name="" wire:model.defer="preguntaId">
                            </div>
                        </div>
                        <div class="px-2 w-1/2">
                            <div>
                                <label for="puntosPreguntaEdit" class="block font-medium text-gray-700">Respuesta Correcta</label>
                                <div class="">
                                    <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                        <input type="checkbox" name="isCorrectEdit" id="isCorrectEdit" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer"
                                        wire:model.defer="isCorrectEdit"/>
                                        <label for="toggle" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                                    </div>
                                    <label for="toggle" class="text-xs text-gray-700">Marcar esta respuesta como correcta.</label>
                                </div>
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
    .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0;
        border-color: #68D391;
    }
    
    .toggle-checkbox:checked + .toggle-label {
        @apply: bg-green-400;
        background-color: #68D391;
    }
</style>


<script>
    window.addEventListener('modalRespuesta', event => {
        //alert('Name updated to: ' + event.detail.idAlumnoActividad);
        document.getElementById('myModal').showModal()
    })
    
    // evento dispara en el navegador genera problemas 
    window.addEventListener('closeModalRespuestas',event => {
        document.getElementById('myModal').close()
        //swal("Good job!", "Se agrego la calificacion a la actividad!", "success");
    })

    window.addEventListener('modalPreguntaEdit', event => {
        //alert('Name updated to: ' + event.detail.idAlumnoActividad);
        document.getElementById('modalPreguntas').showModal()
    })
    
    // evento disparado en el navegador genera problemas 
    window.addEventListener('closeModalPreguntaEdit',event => {
        document.getElementById('modalPreguntas').close()
        //swal("Good job!", "Se Modifixo la pregunta!", "success");
    })

    window.addEventListener('modalRespuestasEdit', event => {
        //alert('Name updated to: ' + event.detail.idAlumnoActividad);
        document.getElementById('modalRespuestasEdit').showModal()
    })
    
    // evento dispara en el navegador genera problemas 
    window.addEventListener('closeModalRespuestasEdit',event => {
        document.getElementById('modalRespuestasEdit').close()
        //swal("Good job!", "Se Modifixo la pregunta!", "success");
    })
</script>