<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    
    <div class="">
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
                                    <div class="category-badge flex-1 h-4 w-4 m rounded-full m-1 bg-blue-100">
                                        <div class="h-2 w-2 rounded-full m-1 bg-blue-500" ></div>
                                    </div>
                                    <div class="category-title flex-1 text-sm">{{ $item->academia }}</div>
                                </div>
                                <a href="{{ route('descripcionCurso',$item->idCurso) }}">
                                    <div class="title-post font-medium font-bold">{{ $item->nombreCurso }}</div>
                                    
                                    <div class="summary-post text-base text-justify">
                                        {{ $item->descripcion }} 
                                    </div>
                                    <div class="summary-post text-base text-justify" >
                                        ({{ $item->horario  }}) - {{ $item->aula }}
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!--@foreach($cursos as $item)-->
                <!--<div class="max-w-xs rounded overflow-hidden shadow-lg bg-white">
                    <img class="w-full" src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=448&q=80" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">
                            <a href="{{ route('descripcionCurso', $item->idCurso ) }}">{{ $item->nombreCurso }}</a>
                        </div>
                        <p class="text-gray-700 text-base">
                            {{ $item->descripcion }}
                        </p>
                    </div>
                </div>-->
            <!--@endforeach-->
        @endif
    </div>
</div>
