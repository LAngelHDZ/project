<div class="">
    {{-- Because she competes with no one, no one can compete with her. --}}
    <div class="shadow rounded-lg bg-white">
        <div class="grid col-span-1 md:flex items-center mt-5 justify-center py-5">
            <div class="mr-14">
                <!--<img class="md:w-40" src="https://i.imgur.com/HvlloWd.png" alt="Logo">-->
            </div>

            <div class="md:mr-4">
                @foreach($datosAlumno as $item)
                <!--<img class="md:w-40" src="https://i.imgur.com/xUbzfdw.png" alt="">-->
                <img src="{{ $pathImage }}" alt="{{ $item->name }}" class="rounded-full object-cover">
                @endforeach
            </div>
            <div class="md:border-l-2 pl-4 p-2 col-span-2 text-justify md:w-1/2 mt-10 md:mt-0">
                @foreach($datosAlumno as $item)
                <p>Nombre: {{ $item->name.' '.$item->lastname  }}</p>
                <p>Email: {{ $item->email }}</p>
                <p class="mt-4">Numero de Control: {{$item->nControl }}</p>
                <p>Carrera: {{ $item->carrera }}</p>
                <p>Semestre: {{ $item->semestre }}</p>
                @endforeach
            </div>
        </div>
    </div>

    @if(count($listExamenes) == 0)
    @else 
    <h4 class="mt-4 text-blue-600 text-2xl font-sans">Examenes</h4>
    
    <div class="mt-2">
        @foreach($listExamenes as $item)
        <div class="shadow rounded-lg bg-white p-4 m-2">
            <div class="grid grid-cols-2 gap-4">
                <div class="">        
                    <h1 class="font-sans text-xl font-semibold">{{ $item->titulo }}</h1>
                    <p class="font-sans text-base">{{ $item->descripcion }}</p>
                </div>
                <div class="">
                    <a href="{{ route('resultadosAlumnos', [$item->idExamen, $idCargaAcademica]) }}" type="button" class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline">
                        Ver Resultados
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    
    @if(count($actividadesAlumno) == 0)
    @else
    <h4 class="mt-2 text-blue-600 text-2xl font-sans">Actividades del Alumno</h4>
    <div class="shadow rounded-lg bg-white my-4">
        <div class="form-task">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 px-4 py-4" >
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actividad</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tema</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hora</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estatus</th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">options</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($actividadesAlumno as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $loop->iteration }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->nombreActividad }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ $item->indice }}.-{{$item->nombreTema }}
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
                                            <div class="flex text-sm text-gray-900">
                                                <button type="button" wire:click="descargarActividad( '{{ $item->archivo }}' )">
                                                    <svg class="w-6 h-6 transform duration-700 ease-in-out hover:scale-150" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                                                    </svg>
                                                </button>
                                                @if($item->actCal == 0)
                                                <button type="button" wire:click="showModal({{ $item->idActividadAlumno }})">
                                                    <svg class="ml-2 w-6 h-6 transform duration-700 ease-in-out hover:scale-150" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                    </svg>
                                                </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!--<div class="grid grid-cols-2 gap-4 mt-5 mb-5">
        <div class="shadow rounded-lg bg-white justify-center h-96 md:h-96">
            <div id="container" style="height: 24rem;"></div>
        </div>
        <div class="shadow rounded-lg bg-white">
            <div id="containerPracticas" style="height: 24rem;"></div>
        </div>
    </div>-->

    <dialog id="myModal" class="w-11/12 md:w-1/2 p-5  bg-white rounded-md ">
        
        <div class="flex flex-col w-full h-auto ">
             <!-- Header -->
            <div class="flex w-full h-auto justify-center items-center">
               <div class="flex w-10/12 h-auto py-3 justify-center items-center text-2xl font-bold">
                    Calificar Actividad
               </div>
               <div onclick="document.getElementById('myModal').close()" class="flex w-1/12 h-auto justify-center cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
               </div>
               <!--Header End-->
            </div>
            
            <!-- Modal Content-->
            <div class="w-full h-auto py-10 px-2 justify-center items-center bg-gray-200 rounded text-center text-gray-500">
                <form action="" method="post" wire:submit.prevent="storeCalificacion">
                    <div>
                        <div>
                            <label for="name" class="block font-medium text-gray-700">Puntuacion</label>
                            <input type="number" min="0" max="100" step="1" name="" id="" class="shadow focus:outline-none focus:shadow-outline apperance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                            wire:model.defer="calificacion">
                        </div>
                        <div>
                            <label for="name" class="block font-medium text-gray-700">Comentarios de la actividad</label>
                            <textarea rows="3" class="shadow focus:outline-none focus:shadow-outline appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight"
                            maxlength="200" wire:model.defer="comentarios"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Agregar Calificacion</button>
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

#journal-scroll::-webkit-scrollbar {
    width: 4px;
    cursor: pointer;
    /*background-color: rgba(229, 231, 235, var(--bg-opacity));*/
}
#journal-scroll::-webkit-scrollbar-track {
    background-color: rgba(229, 231, 235, var(--bg-opacity));
    cursor: pointer;
    /*background: red;*/
}
#journal-scroll::-webkit-scrollbar-thumb {
    cursor: pointer;
    background-color: #a0aec0;
    /*outline: 1px solid slategrey;*/
}
</style>

@push('scripts')

<!--<script src="{{ asset('highcharts/code/highcharts.js') }}"></script>
<script src="{{ asset('highcharts/code/modules/exporting.js') }} "></script>
<script src="{{ asset('highcharts/code/modules/export-data.js') }}"></script>-->

<script>
document.addEventListener('modalCalificacion', event => {
    //alert('Name updated to: ' + event.detail.idAlumnoActividad);
    document.getElementById('myModal').showModal()
})

// evento dispara en el navegador genera problemas 
document.addEventListener('closeModalCalficaciones',event => {
    document.getElementById('myModal').close()
    swal("Good job!", "Se agrego la calificacion a la actividad!", "success");
})

/*document.addEventListener("DOMContentLoaded", () => {
    grafica(@this.faltantes, @this.canActAlumno, @this.canActividades);
    practicas(@this.pracFaltantes, @this.canPracAlumnos, @this.canPracticas);
});

function grafica(faltantes, canActAlumno, canActividades){
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Actividades del Alumno'
        },
        tooltip: {
            pointFormat: '{series.name} - {point.y}:' //<b>{point.percentage:.1f}%</b>
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Actividades',
            colorByPoint: true,
            data: [{
                name: 'Total Actividades',
                y: canActividades,
                sliced: true,
                selected: true
            }, {
                name: 'Entregadas',
                y: canActAlumno
            }, {
                name: 'Faltantes',
                y: faltantes
            },]
        }]
    });
}

function practicas(faltantes, canActAlumno, canActividades){
    Highcharts.chart('containerPracticas', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Practicas del Alumno'
        },
        tooltip: {
            pointFormat: '{series.name} - {point.y}:' //<b>{point.percentage:.1f}%</b>
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        series: [{
            name: 'Practicas',
            colorByPoint: true,
            data: [{
                name: 'Total Practicas',
                y: canActividades,
                sliced: true,
                selected: true
            }, {
                name: 'Entregadas',
                y: canActAlumno
            }, {
                name: 'Faltantes',
                y: faltantes
            },]
        }]
    });
}*/
</script>
@endpush