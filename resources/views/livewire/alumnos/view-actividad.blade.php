<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

    @if( count($listRubrica) == 0)
    @else
    <div class="shadow bg-white p-4 my-5 rounded-lg">
        <h4 class="font-sans text-2xl text-gray-600">Rubrica de Actividad</h4>

        <table class="min-w-full divide-y divide-gray-200 px-4 mt-5 table-auto border-collapse">
            <thead>
                <tr>
                    <th class="border">Criterio</th>
                    <th class="border">Descripcion</th>
                    <th class="border">Puntuacion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($listRubrica as $item)
                <tr>
                    <td class="border px-6 py-4 whitespace-nowrap text-center font-sans text-lg text-gray-500">{{ $item->criterio }}</td>
                    <td class="border px-6 py-4 whitespace-nowrap text-center font-sans text-lg text-gray-500">{{ $item->descripcion }}</td>
                    <td class="border px-6 py-4 whitespace-nowrap text-center font-sans text-lg text-gray-500">{{ $item->puntuacion }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="shadow bg-white p-4 my-5 rounded-lg">
        @foreach($actividad as $item)
            <h4 class="font-sans text-2xl text-gray-600">{{ $item->nombreActividad }}</h4>
            <p class="font-sans text-sm text-gray-400">Fecha de inicio: {{ $item->fechainicio}} Fecha Limite: {{ $item->fechalimite }}</p>


            <div class="mt-11">
                <h4 class="font-sans text-xl text-gray-600">Descripcion Actividad:</h4>
                <p class="font-sans text-base text-gray-500">
                    {{ $item->descripcionActividad }}
                </p>
            </div>

            @if($item->recursos == '' )
            <div class="mt-5">
                No hay recurso de la actividad
            </div>
            @else
            <div class="mt-11">
                <h4 class="font-sans text-xl text-gray-600">Material de Apoyo</h4> 
                <div class="border-2 border-blue-300 rounded-md bg-blue-300 py-2 px-2 w-60">
                    <button type="button" wire:click="downloadRecurso( '{{ $item->recursos  }}' )" class="flex items-start text-lg text-white hover:text-gray-300">
                        <p>Descargar Recurso</p>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </button>
                </div>
            </div>
            @endif
        @endforeach
        
        <div class="mt-11">
            <h4 class="font-sans text-xl text-gray-600">Agregar Actividad</h4>
            @if($verificacionActividad == 1)
            <div class="flex flex-wrap content-center justify-center shadow bg-green-400 h-12 rounded-lg">
                <p>Ya has enviado una actividad </p>
            </div>
            @elseif( date($fechaNow) <= date($fechaLimite) )
            <form action="" method="post" wire:submit.prevent="storeActividad">
                
                <div wire:loading wire:target="archivoactividad" >
                    <div class="flex flex-auto">
                        <svg class="text-blue-700 animate-spin w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        <p class="text-blue-700">Cargando... Espere mientras se termina de cargar el archivo</p> 
                    </div> 
                </div>

                <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md @error('archivoactividad') border-red-600 @enderror">
                    <div class="space-y-1 text-center">
                        <!--<input type="file" name="" id="" wire:model="recurso">-->
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Agregar Archivo</span>
                                <input id="file-upload" name="file-upload" type="file" class="" wire:model="archivoactividad" accept=".pdf,.docx,.pptx">
                            </label>
                            <!--<p class="pl-1">or drag and drop</p>-->
                        </div>
                        <p class="text-xs text-gray-500">
                            PNG, JPG, PDF, DOCX, PPTX up to 25MB
                        </p>
                    </div>
                </div>
                @error('archivoactividad')
                <p class="text-sm text-red-400">{{ $message }}</p>
                @enderror
                
                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white mt-2 py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                    Agregar Actividad 
                </button>
            </form>
            @else
            <p class="flex flex-wrap content-center justify-center shadow bg-red-500 h-12 rounded-lg">Fuera del rango de fecha de entrega</p>
            @endif
        </div>

        @if( count($calificacion)==0 )
        <div class="mt-11">
            <h4 class="font-sans text-xl text-gray-600">Califiacion de la actividad</h4>
            <p class="font-sans text-base text-gray-500">Sin calificacion agregada</p>
        </div>
 
        <div class="mt-11">
            <h4 class="font-sans text-xl text-gray-600">Comentarios</h4>
            <p class="font-sans text-base text-gray-500">Sin comentarios </p>
        </div>
        @else
            @foreach($calificacion as $item)
                <div class="mt-11">
                    <h4 class="font-sans text-xl text-gray-600">Califiacion de la actividad</h4>
                    <p class="font-sans text-base text-gray-500">Su calificacion es de: {{ $item->calificacion }}</p>
                </div>
        
                <div class="mt-11">
                    <h4 class="font-sans text-xl text-gray-600">Comentarios</h4>
                    <p class="font-sans text-base text-gray-500">{{ $item->comentarios }} </p>
                </div>
            @endforeach
        @endif

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {

        Livewire.hook('message.failed', (message, component) => {
            const mensaje = @this.response
            console.log(mensaje+'message failed') 
            if(mensaje == 'pruebas'){
                //swal("Good job!", "You clicked the button!", "success");
            }
        })

        Livewire.hook('message.processed', (message, component) => {
            const mensaje = @this.response
            console.log(mensaje+'message processed')
            
            if(mensaje == 'ok'){
                swal("Good job!", "Se a enviado tu actividad!" , "success");
            }
        })        
    })
</script>
