<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="container mt-5 p-10">
        <livewire:alumnos.star-examen :idExamen="$idExamen"/>
    </div>

</x-app-layout>