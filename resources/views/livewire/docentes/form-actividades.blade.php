<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    
    <div>
        <div class="mt-5">
            <div class="my-5 mx-10 md:mt-0 md:col-span-2">
                <form action="" wire:submit.prevent="actividadStore" enctype="multipart/form-data">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div>
                                <label for="semana" class="block font-medium text-gray-700">Seleccione Semana</label>
                                <div class="inline-block relative w-full">
                                    <select name="genero" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline @error('semanaAct') border-red-600 @enderror"
                                    wire:model="semanaAct">
                                      <option value="" selected>Seleccione</option>
                                      @foreach($semanas as $item)
                                      <option value="{{ $item->idSemanas }}">{{ 'Del '.$item->finicio.' - '.$item->ffinal  }}</option>
                                      @endforeach
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                      <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                @error('semanaAct')
                                <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="tipoactividad" class="block font-medium text-gray-700">Tipo de Actividad</label>
                                <div class="inline-block relative w-full">
                                    <select name="tipoactividad" id="tipoactividad" 
                                    class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline @error('tipoActividad') border-red-600 @enderror"
                                    wire:model="tipoActividad">
                                        <option selected value="">Seleccione</option>
                                        <option value="1">Actividad</option>
                                        <option value="2">Practica</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                    </div>
                                </div>
                                @error('tipoActividad')
                                <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="name" class="block font-medium text-gray-700">Nombre/Titulo Actividad</label>
                                <input type="text" name="name" id="name" class="shadow focus:outline-none focus:shadow-outline appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('nombreActividad') border-red-600 @enderror"
                                wire:model="nombreActividad" maxlength="50">
                                @error('nombreActividad')
                                    <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex ">
                                <div class="flex-auto">
                                    <label for="fechainicio" class="block font-medium text-gray-700">Fecha Inicio</label>
                                    <input type="date" name="fechainicio" id="fechainicio" class="shadow focus:outline-none focus:shadow-outline appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('fechaInicio') border-red-600 @enderror"
                                    wire:model="fechaInicio">
                                    @error('fechaInicio')
                                        <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="flex-auto">
                                    <label for="fechalimite" class="block font-medium text-gray-700">Fecha Limite</label>
                                    <input type="date" name="fechalimite" id="fechalimite" class="shadow focus:outline-none focus:shadow-outline appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('fechaLimite') border-red-600 @enderror"
                                    wire:model="fechaLimite">
                                    @error('fechaLimite')
                                        <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="porcentaje" class="block font-medium text-gray-700">Porcentaje de Actividad (%)</label>
                                <input type="number" name="porcentaje" id="porcentaje" class="shadow focus:outline-none focus:shadow-outline appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('porcentaje') border-red-600 @enderror"
                                min="1" max="100" step="1" wire:model="porcentaje">
                                @error('porcentaje')
                                    <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label for="recurso" class="block font-medium text-gray-700">Descripcion Actividad</label>
                                <div class="mt-1">
                                    <textarea name="recurso" id="recurso" rows="3" class="shadow focus:outline-none focus:shadow-outline appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight @error('descripcionActividad') border-red-600 @enderror"
                                    wire:model="descripcionActividad" maxlength="200"></textarea>
                                </div>
                                <p class="mt-2 text-sm text-gray-500">Breve descripción de la actividad. Las URL tienen hipervínculos.</p>
                                @error('descripcionActividad')
                                    <span class="text-red-500 font-sans text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block font-medium text-gray-700">
                                  Recurso para la Actividad
                                </label>
                                <!--<div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="pl-1 text-sm text-gray-600">document</p>
                                        <p >{{ $recurso }}</p>
                                        <button type="button" class="hover:bg-gray-900" wire:click="eliminarArchivo">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>-->
                                <div wire:loading wire:target="recurso" >
                                    <div class="flex flex-auto">
                                        <svg class="animate-spin w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        <p class="">Cargando... Espere mientras se termina de cargar el archivo</p> 
                                    </div> 
                                </div>
                                <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <!--<input type="file" name="" id="" wire:model="recurso">-->
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Agregar Archivo</span>
                                                <input id="file-upload" name="file-upload" type="file" class="" wire:model="recurso" accept=".pdf,.docx,.pptx">
                                            </label>
                                            <!--<p class="pl-1">or drag and drop</p>-->
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, PDF, DOCX, PPTX up to 25MB
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                                Agregar Actividad 
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('styles')
<!--<link rel="stylesheet" href="{{ asset('css/dropzone.min.css') }}">-->
@endpush

@push('scripts')
<!--<script src="{{ asset('js/dropzone.min.js') }}"></script>-->
@endpush