<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="container">
        <div class="max-w-2xl mx-auto">
            <ul class="flex border-b">
                <li class="-mb-px mr-1">
                    <button wire:click="methodCursosActules" class="bg-white inline-block border-l border-t border-r rounded-t py-2 px-4 text-blue-700 font-semibold">Cursos Actuales</button>
                </li>
                <li class="mr-1">
                    <button wire:click="methodAllCursos" class="bg-white inline-block py-2 px-4 text-blue-500 hover:text-blue-800 font-semibold" >Todo los Cursos</button>
                </li>
            </ul>
        </div>

        <div class="mt-5">
            @if($cursosActules)
                @if(count($cursos) == 0 )
                    <p class="font-sans ">No hay cursos hasta el momento</p>
                @elseif(count($cursos) > 0)
                    <section class="blog text-gray-700 body-font">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
                                @foreach($cursos as $item)
                                <div class="p-4 md:w-1/3 md:mb-0 mb-6 flex flex-col justify-center items-center max-w-sm">
                                    <div class="bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" style="background-image: url(https://images.unsplash.com/photo-1521185496955-15097b20c5fe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1951&q=80)"></div>
                                    <div class="w-70 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
                                        <div class="header-content inline-flex ">
                                            <div class="category-badge flex-1 h-4 w-4 m rounded-full m-1 bg-green-100">
                                                <div class="h-2 w-2 rounded-full m-1 bg-green-500" ></div>
                                            </div>
                                            <div class="category-title flex-1 text-sm">{{ $item->academia }}</div>
                                        </div>
                                        <a href="{{ route('cursos_alumnos.show',$item->idCurso) }}">
                                            <div class="title-post font-medium font-bold">{{ $item->nombreCurso }}</div>
                                            
                                            <div class="summary-post text-base text-justify">
                                                {{ $item->descripcion }} 
                                            </div>
                                            <div class="summary-post text-base text-justify" >
                                                ({{ $item->horario  }}) - {{ $item->aula }}
                                            </div>
                                        </a>                        
                                        <div class="w-full">
                                            <livewire:alumnos.procetanje-curso :cursoId="$item->idCurso" />
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @elseif($allCursos)
                @if(count($cursos) == 0 )
                    <p class="font-sans ">No hay cursos hasta el momento</p>
                @elseif(count($cursos) > 0)
                    <section class="blog text-gray-700 body-font">
                        <div class="container px-5 mx-auto">
                            <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
                                @foreach($cursos as $item)
                                <div class="p-4 md:w-1/3 md:mb-0 mb-6 flex flex-col justify-center items-center max-w-sm">
                                    <div class="bg-gray-300 h-56 w-full rounded-lg shadow-md bg-cover bg-center" style="background-image: url(https://images.unsplash.com/photo-1521185496955-15097b20c5fe?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1951&q=80)"></div>
                                    <div class="w-70 bg-white -mt-10 shadow-lg rounded-lg overflow-hidden p-5">
                                        <div class="header-content inline-flex ">
                                            <div class="category-badge flex-1 h-4 w-4 m rounded-full m-1 bg-green-100">
                                                <div class="h-2 w-2 rounded-full m-1 bg-green-500" ></div>
                                            </div>
                                            <div class="category-title flex-1 text-sm"> {{ $item->academia }}</div>
                                        </div>
                                        <a href="{{ route('cursos_alumnos.show',$item->idCurso) }}">
                                            <div class="title-post font-medium font-bold">{{ $item->nombreCurso }}</div>
                                            
                                            <div class="summary-post text-base text-justify">
                                                {{ $item->descripcion }} 
                                            </div>
                                            <div class="summary-post text-base text-justify" >
                                                ({{ $item->horario  }}) - {{ $item->aula }}
                                            </div>
                                        </a>
                                        <div class="w-full">
                                            <livewire:alumnos.procetanje-curso :cursoId="$item->idCurso" />
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif
            @endif
        </div>
    </div>

</div>
