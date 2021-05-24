<div>
    <div class="">
        <section x-data="togg()">
            <div class="flex justify-end">
               
                <button @click="open(view)" x-text="text" onclick="this.blur()" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"></button>
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
                                            {!! link_to_route('docenteaddActividad', $title = 'Editar', $parameters = [$idcurso, $itema->idSemanas, $type=1], $attributes = ['class'=>'bg-blue-500 p-1  hover:bg-blue-700 text-white font-medium rounded'])!!}
                                           
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
                                                        {{$itemb->nombreActividad}}
                                                        {{-- {!!  link_to_route('cursos.question', $title = $itemb->act, $parameters = [$itemb->id], $attributes = ['class'=>''])!!} --}}
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
</div>
