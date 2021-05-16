<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 ">
      <div class="lg:text-center">
        @if( Auth::user()->tipo_user == 1 )
          <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10">
            Bienvenido alumno(a) {{ Auth::user()->name }}
          </h3>
          <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto">
            "Nunca dejes que nadie te diga que no puedes salvar el semetre."
          </p>
        @elseif( Auth::user()->tipo_user == 2 )
          <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl sm:leading-10 capitalize">
            Bienvenido Profesor(a) {{ Auth::user()->name }}
          </h3>
          <p class="mt-4 max-w-2xl text-xl leading-7 text-gray-500 lg:mx-auto">
            "Los discipulos son la bigrafia del maestro."
          </p>
        @endif
      </div>

      @if(session('type'))
      <div class="flex justify-center mt-5">
        <div class="md:max-w-6xl sm:max-w-6xl lg:max-w-6xl bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
          <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
              <p class="font-bold">Cursos</p>
              <p class="text-sm">Se Envio tu solicitud de inscripcion.</p>
            </div>
          </div>
        </div>
      </div>
      @endif

      @if( !Auth::user()->perfil_completo )
      <div class="flex justify-center mt-5">
        <div class="md:max-w-6xl sm:max-w-6xl lg:max-w-6xl bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
          <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
            <div>
              <p class="font-bold">Importante</p>
              <p class="text-sm">Parece que tu perfil no se a completado aun.</p>
              @if( Auth::user()->tipo_user == 1)
              <a href="{{ route('dsoceco_alumno') }}" class="flex justify-center">Completar Perfil de alumno</a>
              @else
              <a href="{{ route('dsoceco_docente') }}" class="flex justify-center">Completar Perfil de docente</a>
              @endif
            </div>
          </div>
        </div>
      </div>

      @elseif( Auth::user()->perfil_completo && Auth::user()->tipo_user == 1)
        @include('alumnos.viewCursos')
      @elseif( Auth::user()->perfil_completo && Auth::user()->tipo_user == 2)
        @include('docente.cursos_docente')
      @endif

    </div>

  </div>

</x-app-layout>
