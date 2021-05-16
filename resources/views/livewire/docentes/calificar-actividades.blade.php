<div>
    {{-- The best athlete wants his opponent at his best. --}}
    
    <div class="mt-5">
        <select name="actividad" id="actividad" class="bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" wire:model.defer="idActividad">
            <option value="" selected>Seleccione</option>
            @foreach($listTareas as $item)
            <option class="font-sans" value="{{ $item->idActividadTemas }}">
                {{-- $item->nombreActividad.' Tema: '.$item->indice.'.-'.$item->nombreTema --}}
                {{ $item->nombreActividad }}
            </option>
            @endforeach
        </select>

        <button type="button" wire:click="getListAlumnos()" class="inline-block mx-4 px-6 py-2 text-xs font-medium leading-6 text-center text-white uppercase transition bg-blue-700 rounded-full shadow ripple hover:shadow-lg hover:bg-blue-800 focus:outline-none">
            Consultar
        </button>
    </div>

    <div class="rounded-lg bg-white my-4">
    @if($idActividad == null)
        <p>Seleccione Actividad</p>
    @else
        @if(count($listAlumnosTareas) ==0 )
        <p>No se han enviado actividades hasta el momento.</p>
        @else
        <table class="min-w-full divide-y divide-gray-200 px-4" id="example">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alumno</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estatus</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descarga</th>
                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">options</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($listAlumnosTareas as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $loop->iteration }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $item->name.' '.$item->lastname }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ $item->fechaEntrega }}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ $item->hora }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            @if($item->actCal == 1 )
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Calificada
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                S/C
                            </span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            <div class="flex text-sm text-gray-900">
                                <button type="button" wire:click="descargarActividad( '{{ $item->archivo }}' )">
                                    <svg class="w-6 h-6 transform duration-700 ease-in-out hover:scale-150" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->actCal == 0)
                        <div class="flex text-sm text-gray-900">
                            <button type="button" wire:click="showModal({{ $item->idActividadAlumno }})">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </button>
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    @endif
    </div> 

    <dialog id="myModal" class="w-11/12 md:w-1/2 p-5  bg-white rounded-md">
        
        <div class="flex flex-col w-full h-auto ">
            <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
                <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Calificar Actividad
                </div>
                <div wire:click="cancelarCalificacion()" class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </div>
                <!--Header End-->
            </div>
            
            <!-- Modal Content-->
            <div class="w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-center text-gray-500">
                <form action="" method="post" wire:submit.prevent="calificarActividad">
                    <div>
                        <div>
                            <label for="calificacion" class="block font-medium text-gray-700">Puntuacion</label>
                            <input type="number" min="0" max="100" step="1" name="" id="" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                            wire:model.defer="calificacion">
                        </div>
                        <div>
                            <label for="comentario" class="block font-medium text-gray-700">Comentarios de la actividad</label>
                            <textarea rows="3" class="shadow focus:outline-none focus:shadow-outline appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                            maxlength="200" wire:model.defer="comentario"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Agregar Calificacion</button>
                    <button type="button" wire:click="cancelarCalificacion()" class="bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded">Cerrar</button>
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
    window.addEventListener('modalCalificacion', event => {
        //alert('Name updated to: ' + event.detail.idAlumnoActividad);
        document.getElementById('myModal').showModal()
    })
    
    // evento dispara en el navegador genra problemas 
    window.addEventListener('closeModalCalficaciones',event => {
        document.getElementById('myModal').close()
        swal("Good job!", "Se agrego la calificacion a la actividad!", "success");
    })

    window.addEventListener('cancelModalCalificaciones',event => {
        document.getElementById('myModal').close()
        //swal("Good job!", "Se agrego la calificacion a la actividad!", "success");
    })
</script>
    

@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
@endpush

@push('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            "scrollX": true
        } );
    } );
</script>
@endpush
