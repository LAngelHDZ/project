<li class="my-2 md:my-0">
    <a href="{{ route('dashboard') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
        <i class="fas fa-home fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Home</span>
    </a>
</li>

@if( Auth::user()->perfil_completo )
<li class="my-2 md:my-0">
    <a href="{{ route('cursos_docentes.index') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
        <i class="fas fa-chalkboard-teacher fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Cursos</span>
    </a>
</li>
<li class="my-2 md:my-0">
    <a href="{{ route('calActividades') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
        <i class="fas fa-tasks fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Tareas</span>
    </a>
</li>
<!--<li class="my-2 md:my-0 ">
    <a href="{{ route('horario_docente') }}" class="block py-1 md:py-3 pl-1 align-middle text-gray-600 no-underline hover:text-indigo-400">
        <i class="fas fa-tasks fa-fw mr-3"></i><span class="w-full inline-block pb-1 md:pb-0 text-sm">Horario</span>
    </a>
</li>-->
@endif