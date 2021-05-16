<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Datos Socioeconomicos') }}
      </h2>
    </x-slot>

    @if( !Auth::user()->perfil_completo  )
    <div class="container mx-auto px-4 py-10 max-w-6xl">
      <x-jet-validation-errors class="mb-4" />
      <div class="">
        <form action="{{ route('datos_docentes.store') }}" method="post" class="">
          @csrf

          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="lugar_nacimiento">
                Lugar de Nacimiento
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              type="text" name="lugar_nacimiento" id="lugar_nacimiento" placeholder="Lugar Nacimiento" maxlength="50" onkeypress="return soloLetras(event)">
            </div>
  
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fecha_nacimiento">
                Fecha Nacimiento
              </label>
              @php
                $date = \Carbon\Carbon::now();
                $yearmax = $date->year - 18;
                $yearmin = $date->year - 70;
              @endphp
              <select name="dia" id="dia" title="Dia" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="1" selected>1</option>
                @for($i=2; $i<=31; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
              <select name="mes" id="mes" title="Mes" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="1" selected>1</option>
                @for($i=2; $i<=12; $i++)
                <option value="{{ $i }}">{{$i}}</option>
                @endfor
              </select>
              <select name="year" id="year" title="Año" class="shadow border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="{{ $yearmin }}">{{ $yearmin }}</option>
                @for($i=$yearmin+1; $i<=$yearmax; $i++)
                <option value="{{$i}}">{{ $i }}</option>
                @endfor
              </select>
            </div>
  
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="genero">
                Genero
              </label>
              <div class="inline-block relative w-full">
                <select name="genero" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                  <option value="femenino">Femenino</option>
                  <option value="masculino">Masculino</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
            </div>
  
            <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="estado_civil">
                Estado Civil
              </label>
              <div class="inline-block relative w-full">
                <select name="estado_civil" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                  <option value="divorciado">Divorciado</option>
                  <option value="soltero">Soltero</option>
                  <option value="casado">Casado</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>
            </div>

            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="Direccion">
                Direccion
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                id="direccion" name="direccion" type="text" placeholder="Direccion" maxlength="50">
            </div>
  
            <div class="w-full md:w-1/3 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="colonia">
                Colonia
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="colonia" name="colonia" type="text" placeholder="Colonia" maxlength="50">
            </div>
  
            <div class="w-full md:w-1/3 px-3">
              <label for="ciudad" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Ciudad</label>
              <input type="text" name="ciudad" id="ciudad" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="ciudad" placeholder="Ciudad" maxlength="50" onkeypress="return soloLetras(event)">
            </div>

            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono">Telefono</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="telefono" name="telefono" type="text" placeholder="Telefono" maxlength="10" onkeypress="soloNumeros()">
            </div>
  
            <div class="w-full md:w-1/2 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="cp">Codigo Postal</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="codigo_postal" name="codigo_postal" type="text" placeholder="Codigo Postal" maxlength="5" onkeypress="soloNumeros()">
            </div>
          </div>
  
          <hr class="divide-y divide-blue-300">
          <div class="divide-y divide-blue-300">
            <div class="text-center py-1">Datos Medicos</div>
          </div>
  
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label class="uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="curp">CURP</label> <small class="text-sm text-gray-400"> (Letras en Mayusculas)</small>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="curp" name="curp" type="text" placeholder="CURP">
            </div>
  
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label for="ssn" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">SSN</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              type="text" name="ssn" id="ssn" placeholder="SSN" maxlength="11" onkeypress="soloNumeros()">
            </div>
  
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
              <label for="tipo_sangre" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Tipo Sangre</label>
              <div class="inline-block relative w-full">
                <select name="tipo_sangre" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                  <option value="O+">O+</option>
                  <option value="O-">O-</option>
                  <option value="A+">A+</option>
                  <option value="A-">A-</option>
                  <option value="B+">B+</option>
                  <option value="B-">B-</option>
                  <option value="AB+">AB+</option>
                  <option value="AB-">AB-</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                  <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
              </div>    
            </div>

            <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="alergias">Alergias</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="alergias" name="alergias" type="text" placeholder="Alergias" maxlength="50" onkeypress="return soloLetras(event)">
            </div>
  
            <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0">
              <label for="alergias_medicamento" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Alergias a Medicamentos</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              type="text" name="alergias_medicamento" id="alergias_medicamento" placeholder="Alergias a Medicamentos" maxlength="50" onkeypress="return soloLetras(event)">
            </div>
  
            <div class="w-full md:w-1/3 px-3 mb-1 md:mb-0">
              <label for="complicaciones_medicas" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Complicaciones Medicas</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              type="text" name="complicaciones_medicas" id="complicaciones_medicas" placeholder="Complicaciones Medicas" maxlength="50" onkeypress="return soloLetras(event)">    
            </div>

          </div>
  
          <hr class="divide-y divide-blue-300">
          <div class="divide-y divide-blue-300">
            <div class="text-center py-1">Contacto Externo</div>
          </div>
  
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/3 px-3 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contacto_Emergencia">Nombre del Contacto de Emergencia</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="contacto_Emergencia" name="contacto_Emergencia" type="text" placeholder="Contacto de Emergencia" maxlength="50" onkeypress="return soloLetras(event)">
            </div>
            <div class="w-full md:w-1/3 px-3 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono_contacto">Telefono</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="telefono_contacto" name="telefono_contacto" type="text" placeholder="Telefono 1" maxlength="50" onkeypress="soloNumeros()">
            </div>
            <div class="w-full md:w-1/3 px-3 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="parentesco">Parentesco</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="parentesco" name="parentesco" type="text" placeholder="Parentesco" maxlength="50" onkeypress="return soloLetras(event)">
            </div>

            
            <div class="w-full md:w-1/3 px-3 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="contacto_Emergencia2">Nombre del Contacto de Emergencia 2</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="contacto_Emergencia2" name="contacto_Emergencia2" type="text" placeholder="Contacto de Emergencia 2" maxlength="50" onkeypress="return soloLetras(event)">
            </div>
            <div class="w-full md:w-1/3 px-3 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono_contacto2">Telefono</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="telefono_contacto2" name="telefono_contacto2" type="text" placeholder="Telefono" maxlength="10" onkeypress="soloNumeros()">
            </div>
            <div class="w-full md:w-1/3 px-3 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="parentesco2">Parentesco</label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
              id="parentesco2" name="parentesco2" type="text" placeholder="Parentesco" maxlength="50" onkeypress="return soloLetras(event)">
            </div>

          </div>
  
          <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
            Agregar Datos 
          </button>
        </form>
      </div>
    </div>
    @else
    <div class="flex justify-center mt-5">
        <div class="md:max-w-6xl sm:max-w-6xl lg:max-w-6xl bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
          <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
              <p class="font-bold">Importante</p>
              <p class="text-sm">Ya has completado tu perfil anteriormente</p>
            </div>
          </div>
        </div>
    </div>
    @endif
  
  </x-app-layout>