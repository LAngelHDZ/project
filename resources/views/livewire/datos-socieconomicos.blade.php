@if(Auth::user()->perfil_completo)
<x-jet-action-section>
    <x-slot name="title">
        {{ __('Datos Socio Economicos') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actulize la informacion de sus datos Socioeconomicos de su perfil.') }}
    </x-slot>

    <x-slot name="content">
        <form wire:submit.prevent="update">
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 xs:w-2/2 px-3 mb-1 md:mb-0">
                    <x-jet-label for="lugar_nacimiento" value="{{ __('Lugar Nacimiento') }}" />
                    <x-jet-input id="lugar_nacimiento" class="mt-1 block w-full" type="text" wire:model.defer="lugarNac"  onkeypress="return soloLetras(event)"
                    maxlength="50"/>
                    <x-jet-input-error for="lugar_nacimiento" class="mt-2" />
                </div>
                <div class="w-full md:w-1/2 xs:w-2/2 px-3">
                    <x-jet-label for="fecha_nacimiento" value="{{ __('Fecha Nacimiento') }}" />
                    @php
                        $date = \Carbon\Carbon::now();
                        $yearmax = $date->year - 18;
                        $yearmin = $date->year - 70;
                    @endphp
                    <select name="dia" id="dia" title="Dia" wire:model.defer="dia"
                    class="shadow border rounded mt-1 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="1" selected>1</option>
                        @for($i=2; $i<=31; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <select name="mes" id="mes" title="Mes" wire:model.defer="mes"
                    class="shadow border rounded mt-1 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="1" selected>1</option>
                        @for($i=2; $i<=12; $i++)
                        <option value="{{ $i }}">{{$i}}</option>
                        @endfor
                    </select>
                    <select name="year" id="year" title="Año" wire:model.defer="year"
                    class="shadow border rounded mt-1 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="{{ $yearmin }}">{{ $yearmin }}</option>
                        @for($i=$yearmin+1; $i<=$yearmax; $i++)
                        <option value="{{$i}}">{{ $i }}</option>
                        @endfor
                    </select>
                    <x-jet-input-error for="fecha_nacimiento" class="mt-2" />
                </div>

                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <x-jet-label for="genero" value="{{ __('Genero') }}" />
                    <div class="inline-block relative w-full">
                        <select name="genero" wire:model.defer="genero" class="w-full mt-1 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="femenino">Femenino</option>
                            <option value="masculino">Masculino</option>
                        </select>
                    </div>
                    <x-jet-input-error for="genero" class="mt-2" />
                </div>

                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <x-jet-label for="estado_civil" value="{{ __('Estado Civil') }}" />
                    <div class="inline-block relative w-full">
                        <select name="estado_civil" wire:model.defer="estado_civil" class="w-full mt-1 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="divorciado">Divorciado</option>
                            <option value="soltero">Soltero</option>
                            <option value="casado">Casado</option>
                        </select>
                    </div>
                    <x-jet-input-error for="estado_civil" class="mt-2" />
                </div>

                <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
                    <x-jet-label for="_direccion" value="{{ __('Direccion') }}" />
                    <x-jet-input id="_direccion"  type="text" class="mt-1 block w-full" wire:model.defer="direccion" maxlength="50"/>
                    <!--<input type="hidden" name="idDatos" wire:model="idDatos">-->
                    <x-jet-input-error for="_direccion" class="mt-2" />
                </div>
      
                <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
                    <x-jet-label for="_colonia" value="{{ __('Colonia') }}" />
                    <x-jet-input id="_colonia" type="text" class="mt-1 my-1 block w-full" wire:model.defer="colonia" maxlength="50"/>
                    <x-jet-input-error for="_colonia" class="mt-2" />
                </div>
      
                <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
                    <x-jet-label for="ciudad" value="{{ __('Ciudad') }}" />
                    <x-jet-input id="ciudad" name="ciudad" type="text" class="mt-1 block w-full" wire:model.defer="ciudad" onkeypress="return soloLetras(event)"
                    maxlength="50"/>
                    <x-jet-input-error for="ciudad" class="mt-2" />
                </div>

                <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
                    <x-jet-label for="telefono" value="{{ __('Telefono') }}" />
                    <x-jet-input id="telefono" name="telefono" type="text" class="mt-1 my-1 block w-full" wire:model.defer="telefono" onkeypress="soloNumeros()"
                    maxlength="10"/>
                    <x-jet-input-error for="telefono" class="mt-2" />
                </div>

                <div class="w-full md:w-1/5 px-3 mb-6 md:mb-0">
                    <x-jet-label for="cp" value="{{ __('Codigo Postal') }}" />
                    <x-jet-input id="cp" name="cp" type="text" class="mt-1 block w-full" wire:model.defer="cp" onkeypress="soloNumeros()"
                    maxlength="5"/>
                    <x-jet-input-error for="cp" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/4 px-3 mb-6 md:mb-0">
                    <x-jet-label for="curp" value="{{ __('CURP') }}" />
                    <x-jet-input id="curp" name="curp" type="text" class="mt-1 block w-full" wire:model.defer="curp" maxlength="20"/>
                    <x-jet-input-error for="curp" class="mt-2" />
                </div>

                <div class="w-full md:w-1/4 px-3">
                    <x-jet-label for="numSeguro" value="{{ __('SSN') }}" />
                    <x-jet-input id="numSeguro" name="numSeguro" type="text" class="mt-1 my-1 block w-full" wire:model.defer="numSeguro" onkeypress="soloNumeros()"
                    maxlength="11"/>
                    <x-jet-input-error for="numSeguro" class="mt-2" />
                </div>

                <div class="w-full md:w-1/4 px-3">
                    <x-jet-label for="tipo_sangre" value="{{ __('Tipo Sangre') }}" />
                    <div class="inline-block relative w-full">
                        <select name="tipo_sangre" wire:model.defer="tipo_sangre" class="mt-1 bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                    </div>
                    <x-jet-input-error for="tipo_sangre" class="mt-2" />
                </div>

                <div class="w-full md:w-1/4 px-3">
                    <x-jet-label for="alergias" value="{{ __('Alergias') }}" />
                    <x-jet-input id="alergias" name="alergias" type="text" class="mt-1 my-1 block w-full" wire:model.defer="alergias" onkeypress="return soloLetras(event)"
                    maxlength="50"/>
                    <x-jet-input-error for="alergias" class="mt-2" />
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="alergia_medicamentos" value="{{ __('Alergia a Medicamentos') }}" />
                    <x-jet-input id="alergia_medicamentos" name="alergia_medicamentos" type="text" class="mt-1 block w-full" wire:model.defer="medAlergias" onkeypress="return soloLetras(event)"
                    maxlength="50"/>
                    <x-jet-input-error for="alergia_medicamentos" class="mt-2" />
                </div>

                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label for="complicaciones_medicas" value="{{ __('Complicaciones Medicas') }}" />
                    <x-jet-input id="complicaciones_medicas" name="complicaciones_medicas" type="text" class="mt-1 my-1 block w-full" wire:model.defer="compliMedicas" onkeypress="return soloLetras(event)"
                    maxlength="50"/>
                    <x-jet-input-error for="complicaciones_medicas" class="mt-2" />
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/3 px-3">
                    <x-jet-label for="contacto_emergencia" value="{{ __('Contacto Emergencia') }}" />
                    <x-jet-input id="contacto_emergencia" name="contacto_emergencia" type="text" class="mt-1 block w-full" wire:model.defer="contacto" onkeypress="return soloLetras(event)"
                    maxlength="50"/>
                    <x-jet-input-error for="contacto_emergencia" class="mt-2" />
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <x-jet-label for="parentesco" value="{{ __('Parentesco') }}" />
                    <x-jet-input id="parentesco" class="parentesco" type="text" class="mt-1 my-1 block w-full" wire:model.defer="parentesco1" onkeypress="return soloLetras(event)"
                    maxlength="50"/>
                    <x-jet-input-error for="parentesco" class="mt-2" />
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <x-jet-label for="telefono_1" value="{{ __('Telefono ') }}" />
                    <x-jet-input id="telefono_1" name="telefono_1" type="text" class="mt-1 block w-full" wire:model.defer="tel1" onkeypress="soloNumeros()"
                    maxlength="10"/>
                    <x-jet-input-error for="telefono_1" class="mt-2" />
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <x-jet-label for="contacto2" value="{{ __('Contacto Emergencia 2') }}" />
                    <x-jet-input id="contacto2" name="contacto2" type="text" class="mt-1 my-1 block w-full" wire:model.defer="contacto2" onkeypress="return soloLetras(event)"
                    maxlength="50"/>
                    <x-jet-input-error for="contacto2" class="mt-2" />
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <x-jet-label for="parentesco2" value="{{ __('Parentesco') }}" />
                    <x-jet-input id="parentesco2" class="parentesco" type="text" class="mt-1 my-1 block w-full" wire:model.defer="parentesco2" onkeypress="return soloLetras(event)" maxlength="50"/>
                    <x-jet-input-error for="parentesco2" class="mt-2" />
                </div>

                <div class="w-full md:w-1/3 px-3">
                    <x-jet-label for="telefono_2" value="{{ __('Telefono ') }}" />
                    <x-jet-input id="telefono_2" name="telefono_1" type="text" class="mt-1 block w-full" wire:model.defer="tel2" onkeypress="soloNumeros()" maxlength="10"/>
                    <x-jet-input-error for="telefono_2" class="mt-2" />
                </div>
            </div>

            <div class="flex justify-end mb-1">
                <div class="mt-3">
                    <p class="animate-pulse text-gray-400 mx-8" id="mensajeSave">
                        {{ $message }}
                    </p>
                    <x-jet-button id="save">
                        {{ __('Guardar') }}
                    </x-jet-button>  
                </div>
            </div>
        </form>
    </x-slot>
</x-jet-action-section>

@else
<x-jet-form-section submit="update">
    <x-slot name="title">
        {{ __('Datos Socio Economicos') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Actulize la informacion de sus datos Socioeconomicos de su perfil.') }}
    </x-slot>

    <x-slot name="form">
        <p>Complete perfil primero</p>
    </x-slot>

    <x-slot name="actions">         
    </x-slot>
</x-jet-form-section> 
@endif