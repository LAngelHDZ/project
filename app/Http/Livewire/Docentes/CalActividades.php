<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Docente;
use App\Models\CalActividad;
use Illuminate\Support\Facades\Storage;

class CalActividades extends Component
{
    public $idalumno, $idcurso, $idactividad, $showCursos =true;
    public $listAlumnos, $listTareas, $calificacion, $comentario, $idactividadAlumno;
    
    public function render()
    {
        $curso = $this->getCursoActuales();
        $this->getTareas($this->idcurso);
        $this->getAlumnos();
        return view('livewire.docentes.cal-actividades',['cursos' => $curso]);
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


    public function getCursoActuales(){
        
        $idDocente = Docente::where('user_id', Auth::user()->id )->first();

        $year = date('Y');
        $mes = date('m');

        if($mes < 6){
            $periodo = 'Enero-Junio';
        }else if($mes > 6){
            $periodo = 'Agosto-Diciembre';
        }else{
            $periodo = 'Verano';
        }

        $cursos = DB::table('curso')
        ->join('periodo','curso.periodo_id','=','idPeriodo')
        ->join('materias', 'curso.materia_id', '=', 'idMateria')
        ->where('docente_id',$idDocente->idDocente)
        ->where('periodo.year', $year)
        ->where('periodo.periodo', $periodo)
        ->select('curso.*', 'materias.academia')
        ->paginate(6);

        return $cursos;
    }

    public function seleccionarCurso($id){
        //$this->idcurso = $id; 
        $this->showCursos = false;

        $this->getTareas($id);
    }

    public function getTareas($curso){
        $this->idcurso = $curso; 
        $this->listTareas = DB::table('actividadtemas')
        ->join('temas', 'actividadtemas.temas_id', '=', 'temas.idTema')
        ->select('temas.indice', 'temas.nombreTema', 'actividadtemas.*')
        ->where('actividadtemas.curso_id', $this->idcurso )
        ->get();
    }

    public function getAlumnos(){

        /*$this->listAlumnos = DB::table('actividades_alumnos')
        ->join('alumnos', 'actividades_alumnos.alumno_id', '=', 'alumnos.idAlumno')
        ->join('users', 'alumnos.user_id', '=', 'users.id')
        ->where('actividades_alumnos.actividad_id', $this->idactividad)
        ->select('users.name', 'users.lastname', 'alumnos.nControl','actividades_alumnos.*')
        ->get();*/

        $this->listAlumnos = DB::table('actividades_alumnos')
        ->join('alumnos', 'actividades_alumnos.alumno_id', '=', 'alumnos.idAlumno')
        ->join('users', 'alumnos.user_id', '=', 'users.id')
        ->where('actividades_alumnos.actividad_id', $this->idactividad)
        ->whereNotExists(function($query){
            $query->select(DB::raw(1))
            ->from('cal_actividades')
            ->whereColumn('cal_actividades.tarea_id', 'actividades_alumnos.idActividadAlumno');
        })
        ->select('users.name', 'users.lastname', 'alumnos.nControl','actividades_alumnos.*')
        ->get();
    }

    public function descargarActividad($path){
        return Storage::download($path);
    }

    public function cancelarCalificacion(){   
        $this->calificaion = 0;
        $this->comentario = '';
        $this->idactividadAlumno = 0;
        $this->listAlumnos = null;
        $this->listTareas = null;
        $this->showCursos = true;
    }

    public function showModal($idactividadalumno){
        $this->idactividadAlumno = $idactividadalumno;
        $this->dispatchBrowserEvent('modalCalificacion');
    }

    public function closeShowModal(){
        $this->dispatchBrowserEvent('closeModalCalficaciones');
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
