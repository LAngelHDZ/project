<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Docente;
use App\Models\CalActividad;
use Illuminate\Support\Facades\Storage;

class CalificarActividades extends Component
{
    public $cursoId;
    public $listTareas, $idActividad, $listAlumnosTareas;
    public $calificacion=0, $comentario='', $idactividadAlumno=0;

    public function render()
    {
        $this->getTareas();
        $this->getListAlumnos();
        return view('livewire.docentes.calificar-actividades');
    }

    protected $rules = [
        'calificacion' => 'required|integer|min:0|max:100',
        'comentario' => 'string|max:200'
    ];

    protected $messages = [
        'calificacion.min' => 'La puntuacion minima es 0',
        'calificacion.max' => 'La Calificacion maxima es 100',
        'calificacion.required' => 'Este campo es requerido',
        'comentario.max' => 'La cantidad de caracteres permitidos es 200'
    ];

    public function getTareas(){
        $this->listTareas = DB::table('actividadtemas')
        ->join('temas', 'actividadtemas.temas_id', '=', 'temas.idTema')
        ->select('temas.indice', 'temas.nombreTema', 'actividadtemas.*')
        ->where('actividadtemas.curso_id', $this->cursoId )
        ->get();
    }

    public function getListAlumnos(){
        $this->listAlumnosTareas = DB::table('actividades_alumnos')
        ->join('actividadtemas', 'actividades_alumnos.actividad_id','=','actividadtemas.idActividadTemas')
        ->join('alumnos', 'actividades_alumnos.alumno_id', '=', 'alumnos.idAlumno')
        ->join('users', 'alumnos.user_id', '=', 'users.id')
        ->leftJoin('cal_actividades', 'actividades_alumnos.idActividadAlumno','=','cal_actividades.tarea_id')
        ->select('users.name', 'users.lastname', 'alumnos.nControl','actividadTemas.nombreActividad','actividades_alumnos.*',DB::raw('case when cal_actividades.tarea_id IS NULL then 0 ELSE 1 END AS actCal'))
        ->where('actividadtemas.curso_id', $this->cursoId)
        ->where('actividades_alumnos.actividad_id', $this->idActividad )
        ->get();
    }

    public function descargarActividad($path){
        return Storage::download($path);
    }

    public function showModal($idactividadalumno){
        $this->idactividadAlumno = $idactividadalumno;
        $this->dispatchBrowserEvent('modalCalificacion');
    }

    public function closeShowModal(){
        $this->calificacion = 0;
        $this->comentario = '';
        $this->idactividadAlumno = 0;

        $this->dispatchBrowserEvent('closeModalCalficaciones');
    }

    public function cancelShowModal(){
        $this->dispatchBrowserEvent('cancelModalCalificaciones');
    }

    public function cancelarCalificacion(){   
        $this->calificacion = 0;
        $this->comentario = '';
        $this->idactividadAlumno = 0;

        $this->cancelShowModal(); 
    }

    public function calificarActividad(){
        $this->validate();
        
        $calificacion = new CalActividad;
        $calificacion->calificacion = $this->calificacion;
        $calificacion->comentarios = $this->comentario;
        $calificacion->tarea_id = $this->idactividadAlumno;
        $calificacion->save();

        $this->closeShowModal(); 
    }

}
