<div>
    {{-- Do your work, then step back. --}}
    
    <div class="">
        <section x-data="togg()">
            <div class="flex justify-end">
               
                {{-- <button @click="open(view)" x-text="text" onclick="this.blur()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"></button> --}}
            </div>
            <div class="p-1  border-gray-300 border-solid border mt-3">
                @foreach ($semanas as $itema)
                    <div class="border-b border-blue-700 ">
                        <div class="grid grid-cols-2 mt-2">
                            <div class="pl-1 " >
                                <ul class="">
                                    <li class="text-xl mx-3 text-blue-800">
                                        {{'Semana '.$itema->finicio.' al '.$itema->ffinal}}  
                                    </li>
                                </ul>
                            </div>
                            <div  class="flex justify-end pr-1 " >
                                <div  class="m-1">
                                    <ul >
                                        <li x-show.transition.opacity="setOpen()" >
                                            {{-- <a href="{{ route('docenteaddActividad',['curso'=> $idcurso,'idtype' => $itema->idSemanas, 'type'=>1]) }}" class="bg-blue-500 p-1  hover:bg-blue-700 text-white font-medium rounded" title="Editar">
                                            </a> --}}
                                            {{-- {!! link_to_route('docenteaddActividad', $title = 'Editar', $parameters = [$idcurso, $itema->idSemanas, $type=1], $attributes = ['class'=>'bg-blue-500 p-1  hover:bg-blue-700 text-white font-medium rounded'])!!} --}}
                                           
                                            {{-- <a href="" class="bg-blue-500 p-1  hover:bg-blue-700 text-white font-medium rounded">Editar</a> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="my-2">
                            @foreach ($actividades as $itemb)
                                <div class="  col-span-2 ">
                                    <div class="grid grid-cols-2">
                                        @if($itema->idSemanas === $itemb->semana_id)
                                            <div class="pl-4 my-2 " >
                                                <ul class="">
                                                    <li>
                                                        {{-- {{$itemb->nombreActividad}} --}}
                                                        {!!  link_to_route('viewActividadAlumno', $title = $itemb->nombreActividad, $parameters = [$itemb->idActividadTemas], $attributes = ['class'=>''])!!}
                                                        {{-- {!!  link_to_route('cursos.question', $title = $itema->nombreActividad, $attributes = ['class'=>''])!!} --}}
                                                    </li>
                                                </ul>
                                            </div>
                                        
                                            <div  class="flex justify-end pr-1 my-2 " >
                                                <ul >
                                                    <li x-show.transition.opacity="setOpen()" >
                                                        {{-- {!! link_to_route('cursos.create', $title = 'Editar', $parameters = [$itemb->id], $attributes = ['class'=>'bg-green-500 p-1  mr-10  hover:bg-green-700 text-white rounded'])!!}
                                                         --}}
                                                         {{-- {!! link_to_route('cursos.create', $title = 'Editar', $attributes = ['class'=>'bg-green-500 p-1  mr-10  hover:bg-green-700 text-white rounded'])!!} --}}
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach     
                        </div>
                    </div>
                @endforeach    
            </div>
        </section>

        <script>
            function togg(){
                return{
                    view: false,
                    text: 'Activar edición',

                    open:function(view) {
                        if(!view){
                            this.view = true; this.text ="Cerrar edición";

                        }else{
                            this.view = false; this.text="Activar edición";
                        }
                    },
                    setOpen(){ return this.view === true}

                }   
            }

        </script>
    </div>

    {{-- <div class="mt-1 px-10">
    @if(count($examenCurso) > 0)
        <h4 class="text-xl text-blue-400 font-bold">Examenes </h4>
        @foreach($examenCurso as $item)
           
        <div class="md:container md:mx-auto bg-white rounded-lg border-dashed shadow-md mt-2 px-15">
            <div class="flex ">
                <div class="w-1/2 p-2">
                    <p>{{ $item->titulo }}</p>
                    <p>{{ $item->descripcion }}</p>
                    <p>Fecha de Apertura: {{ $item->fecha_apertura.' - '.$item->fechalimite }}</p>
                    <p>Hora de Apertura: {{ $item->hora_apertura.' - '.$item->horalimite  }}</p>
                </div>
                @if($this->verificarExamen($item->idExamen ) == 0)
                <div class="w-1/2 flex flex-wrap content-center">
                    <a href="{{ route('viewExamenAlumno', $item->idExamen ) }}" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-blue-500 hover:bg-blue-600 hover:shadow-lg">Ir al examen</a>
                </div>
                @else
                <div class="w-1/2 flex flex-wrap content-center">
                    <a href="{{ route('resultadosStudent', $item->idExamen ) }}" class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-green-500 hover:bg-green-600 hover:shadow-lg">Ver Resultados</a>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    @endif
    </div>

    @if(count($actividadTema) == 0)
        <p class="font-sans text-xl text-black text-center">No hay actividades Agregadas</p>
    @else
    <div class="mb-5 px-10">
        <h4 class="mt-4 text-xl text-blue-400 font-bold">Actividades</h4>
        @php 
            $idSemana = '';
        @endphp
        @foreach($actividadTema as $item)

        @if($idSemana != $item->semana_id )
            @php
                $formato = $item->finicio;
                $formato2 = $item->ffinal; 
                $date = strtotime($formato);
                $date2 = strtotime($formato2);
                    
                setlocale(LC_ALL,"spanish");
                $fechaespanol = strftime("%A %d de %B del %Y", $date);
                $fechaespanol2 = strftime("%A %d de %B del %Y", $date2);
            @endphp
            <p class="font-sans text-lg mt-2 capitalize">Semana: {{ $fechaespanol }} al {{ $fechaespanol2 }} </p>
        @endif

        @php
            $idSemana = $item->semana_id;
        @endphp

        @if($item->tipo == 1 )       
        <div class="md:container md:mx-auto bg-gray-50 rounded-lg border-dashed shadow-md mt-2 px-15">
            <div class="flex">
                <div class="flex-none h-16 content-center">
                    <!--<i class="far fa-square my-6 mr-5 transform scale-150"></i>-->
                    @if($item->actEntregada == 0)
                    <svg class="w-10 h-10 my-4 mr-5 border-dashed border-4 border-light-blue-500 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    @else                    
                    <svg class="w-10 h-10 my-4 mr-5 border-dashed border-4 border-light-blue-500 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    @endif
                    <!--<i class="fas fa-chalkboard fa-fw mr-3"></i>-->
                </div>
                <div class="flex-grow h-18">
                    <a href="{{ route('viewActividadAlumno', $item->idActividadTemas ) }}">
                        <h1 class="font-sans text-xl text-black text-left">{{ $item->indice.'.- '.$item->nombreTema }}</h1>
                        <h3 class="font-sans text-base text-gray-800 text-right">
                            @if($item->tipoActividad == 1)
                            <p> <span class="font-bold">Actividad:</span>  {{ $item->nombreActividad }}</p> 
                            @else
                            <p> <span class="font-bold">Practica:</span> {{ $item->nombreActividad }} </p> 
                            @endif
                        </h3>
                        <h4 class="font-sans text-base text-gray-800 text-right">Fecha de inicio: {{ $item->fechainicio }} Fecha final: {{ $item->fechalimite }}</h4>
                    </a>
                </div>
            </div>
        </div>
        @elseif($item->tipo == 2 )
        <div class="w-11/12 bg-gray-50 rounded-lg border-dashed shadow-md mt-1 ml-15 px-15">
            <div class="flex">
                <div class="flex-none h-12 content-center">
                    @if($item->actEntregada == 0)
                    <svg class="w-6 h-6 my-4 mr-5 border-dashed border-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    @else
                    <svg class="w-6 h-6 my-4 mr-5 border-dashed border-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                    </svg>
                    @endif
                </div>
                <div class="flex-grow h-16">
                    <a href="{{ route('viewActividadAlumno', $item->idActividadTemas ) }}">
                        <h1 class="font-sans text-base text-black text-left">{{ $item->indice.'.- '.$item->nombreTema }}</h1>
                        <h3 class="font-sans text-sm text-gray-800 text-right">
                            @if($item->tipoActividad == 1)
                            <p> <span class="font-bold">Actividad:</span>  {{ $item->nombreActividad }}</p> 
                            @else
                            <p> <span class="font-bold">Practica:</span> {{ $item->nombreActividad }} </p> 
                            @endif
                        </h3>
                        <h4 class="font-sans text-sm text-gray-800 text-right">Fecha de Inicio: {{ $item->fechainicio }} Fecha Limite: {{$item->fechalimite}}</h4>
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
    @endif --}}
    
      
</div>
