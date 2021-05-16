<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <!--<x-jet-authentication-card-logo />-->
            <img src="{{ asset('img/logo-ita.png') }}" alt="logo tecnologico" width="100px" height="100px">
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('app_register_docente') }}">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <x-jet-label value="{{ __('Nombre') }}" />
                    <x-jet-input class="block mt-1 w-full capitalize" type="text" name="name" :value="old('name')" 
                    required autofocus autocomplete="name" placeholder="Escribe tu Nombre" onkeypress="return soloLetras(event)"/>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label value="{{ __('Apellidos') }}"></x-jet-label>
                    <x-jet-input class="block mt-1 w-full capitalize" type="text" name="lastname" :value="old('lastname')" 
                    required autocomplete="lastname" placeholder="Escribe tus Apellidos" onkeypress="return soloLetras(event)"></x-jet-input>
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-0">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <x-jet-label value="{{ __('Clave del Docente') }}"></x-jet-label>
                    <x-jet-input class="block mt-1 w-full" type="text" name="matricula" :value="old('matricula')" 
                    required placeholder="Clave de Docente" maxlength="8" onkeypress="soloNumeros()" ></x-jet-input>
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <label for="RFC" class="text-sm">RFC</label><small class="text-xs text-gray-400"> (Letras en Mayusculas) </small>
                    <x-jet-input class="block mt-1 w-full" type="text" name="rfc" required placeholder="Escribe RFC" ></x-jet-input>
                </div>
            </div>

            <div class="mt-4">
                <label for="email" class="text-sm">Email</label><small class="text-sm text-gray-400"> (Institucional)</small>
                <x-jet-input class="block mt-1 w-full" type="email" name="email" :value="old('email')" 
                required placeholder="Lxxxxxxxx@acapulco.t" />
            </div>

            <div class="flex flex-wrap -mx-3 mt-4">
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <x-jet-label value="{{ __('Password') }}" />
                    <x-jet-input class="block mt-1 w-full" type="password" name="password" 
                    required autocomplete="new-password" />
                </div>
                <div class="w-full md:w-1/2 px-3">
                    <x-jet-label value="{{ __('Confirm Password') }}" />
                    <x-jet-input class="block mt-1 w-full" type="password" name="password_confirmation" 
                    required autocomplete="new-password" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Ya estoy registrado?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Registrarme') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
