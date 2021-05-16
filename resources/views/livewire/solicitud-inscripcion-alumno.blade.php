<div>
    <div class="container mx-auto px-4">
        @foreach( $curso as $item)
        <h2 class="my-5 font-serif text-gray-600 text-2xl text-center">Curso: {{ $item->nombreCurso}} </h2>
        @endforeach
  
        <div class="grid grid-cols-6 gap-4">
            <div class="col-start-2 col-span-4">
                <div class="flex justify-center bg-white">
                    @foreach($curso as $item)
                    <div class="md:flex rounded-lg p-6 max-w-2xl">
                        <img class="h-16 w-16 md:h-24 md:w-24 rounded-full mx-auto md:mx-0 md:mr-6" src="{{ Auth::user()->profile_photo_url }}">
                        <div class="text-center md:text-left">
                        <h2 class="text-lg capitalize">{{ $item->name.' '.$item->lastname }}</h2>
                            <div class="text-purple-500">Product Engineer</div>
                            <div class="text-gray-600">erinlindford@example.com</div>
                            <div class="text-gray-600">(555) 765-4321</div>
                        </div>
                    </div>   
                    @endforeach     
                </div>
            </div>
    
          <div class="col-start-1 col-end-3">
            <h4 class="text-3xl text-blue-700">Acerca del curso</h4>
            <div class="">
              @foreach($curso as $item)
              <p class="text-sm text-gray-600">
                "{{ $item->acercadelcurso }}"
              </p>
              @endforeach
            </div>
  
            <h4 class="text-3xl text-blue-700">Descripcion</h4>
            <div class="">
              @foreach($curso as $item)
                <p class="text-sm text-gray-600">
                  "{{ $item->descripcion }}"
                </p>
              @endforeach
            </div>
          </div>
          
          <div class="col-end-7 col-span-3">
            <h3 class="text-3xl text-blue-700">Contenido del Curso</h3>
            <div class="card mx-5">
              @foreach($curso as $item)
                <livewire:temas-materia :idMateria="$item->materia_id" ></livewire:temas-materia>
              @endforeach
            </div>
          </div>
        </div>
    
    </div>
  
    <div class="container mx-auto px-4 text-center my-5">
        @if($solicitudes == 1)
        <p class="animate-pulse"><small class="text-sm text-gray-600">Ya has realizado una solicitud espera a ser aceptado</small></p>
        <button type="button" disabled class="cursor-wait disabled:opacity-50 bg-blue-500 text-white font-bold py-2 px-4 rounded" disabled>
            Enviar Solicitud de Inscrpcion
        </button>
        @else
        <form action="{{ route('sendSolicitud') }}" method="post">
            @csrf
            <input type="hidden" name="curso" wire:model="cursoId">
            <input type="hidden" name="alumno" wire:model="alumnoId">

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
              Enviar Solicitud de Inscripcion
            </button>
        </form>
        @endif
    </div>

</div>
