<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\CalActividad;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class DescripcionAlumno extends Component
{
    use WithFileUploads;

    public $idalumno, $idcurso, $datosAlumno,$actividadesAlumno, $confirmingUserDeletion, $pathImage, $response, $isOpen=0;
    public $idCargaAcademica;
    public $calificacion=0, $comentarios, $idactividad, $sumCal=0;
    public $recurso, $canActAlumno=0, $canActividades=0, $faltantes=0;
    public $pracFaltantes=0, $canPracticas=0, $canPracAlumnos=0;
    public $listExamenes;

    protected $rules = [
        'calificacion' => 'required|integer|min:0|max:100',
        'comentarios' => 'string|max:200'
    ];

    protected $messages = [
        'calificacion.min' => 'La puntuacion minima es 0',
        'calificacion.max' => 'La Calificacion maxima es 100',
        'calificacion.required' => 'Este campo es requerido',
        'comentarios.max' => 'La cantidad de caracteres permitidos es 200'
    ];
    
    public function render()
    {
        $this->getActividadesAlumno(); 
        $this->getDatosAlumno();
        $this->consActCal();
        $this->consPracticasCalificadas();
        $this->getExamenes();
        //$this->datosGrafica();
        //$this->datosGraficaPracticas(); 
        return view('livewire.docentes.descripcion-alumno');
    }

    public function getDatosAlumno(){
        $this->datosAlumno = DB::table('alumnos')
        ->join('users', 'alumnos.user_id', '=', 'users.id')
        ->join('carga_academica', 'alumnos.idAlumno', '=', 'carga_academica.alumno_id')
        ->select('alumnos.nControl', 'alumnos.carrera', 'alumnos.semestre', 'users.name', 'users.lastname', 'users.email', 'carga_academica.idCA')
        ->where('alumnos.idAlumno', $this->idalumno)
        ->get(); 

        $name ='';
        foreach($this->datosAlumno as $item){
            $name = $item->name; 
            $this->idCargaAcademica = $item->idCA;
        }

        $this->pathImage = "https://ui-avatars.com/api/?name=".$name."&background=random";
    }

    public function getActividadesAlumno(){
        $this->actividadesAlumno = DB::table('actividadTemas')
        ->join('temas', 'actividadTemas.temas_id', '=', 'temas.idTema')
        ->join('actividades_alumnos', 'actividadTemas.idActividadTemas', '=', 'actividades_alumnos.actividad_id')
        ->leftJoin('cal_actividades', 'actividades_alumnos.idActividadAlumno','=','cal_actividades.tarea_id')
        ->select('actividadTemas.nombreActividad', 'temas.indice', 'temas.nombreTema', 'actividades_alumnos.*',DB::raw('case when cal_actividades.tarea_id IS NULL then 0 ELSE 1 END AS actCal'))
        ->where('actividadTemas.curso_id', $this->idcurso)
        ->get(); 
    }

    public function showModal($idactividadalumno){
        $this->dispatchBrowserEvent('modalCalificacion', ['idAlumnoActividad' => $idactividadalumno]);
        $this->idactividad = $idactividadalumno;
    }

    public function closeShowModal(){
        $this->dispatchBrowserEvent('closeModalCalficaciones');
    }

    public function closeModal(){
        $this->isOpen = false;
        $this->calificaion = 0;
        $this->comentarios = '';
    }

    public function openModal(){
        $this->isOpen = true;
    }

    public function descargarActividad($actividad){
        //$this->recurso = $actividad;
        return Storage::download($actividad);
    } 

    public function storeCalificacion(){
        $this->validate();

        $calificacion = new CalActividad;
        $calificacion->calificacion = $this->calificacion;
        $calificacion->comentarios = $this->comentarios;
        $calificacion->tarea_id = $this->idactividad;
        $calificacion->save();

        $this->response = 'ok';
        $this->calificaion = 0;
        $this->comentarios = '';
        $this->idactividad = 0;
        $this->closeShowModal(); 
    }

    public function consActCal(){
        $calificaciones = DB::table('actividades_alumnos')
        ->join('actividadtemas', 'actividades_alumnos.actividad_id', '=', 'actividadtemas.idActividadTemas')
        ->join('cal_actividades', 'actividades_alumnos.idActividadAlumno','=','cal_actividades.tarea_id')
        ->where('actividadtemas.curso_id', $this->idcurso)
        ->where('actividades_alumnos.alumno_id', $this->idalumno)
        ->where('actividadtemas.tipoActividad', 1)
        ->select('actividadtemas.nombreActividad','cal_actividades.calificacion')
        ->get();
        
        $this->canActAlumno = count($calificaciones);
    }

    public function consPracticasCalificadas(){
        $practicas = DB::table('actividades_alumnos')
        ->join('actividadtemas', 'actividades_alumnos.actividad_id', '=', 'actividadtemas.idActividadTemas')
        ->join('cal_actividades', 'actividades_alumnos.idActividadAlumno','=','cal_actividades.tarea_id')
        ->where('actividadtemas.curso_id', $this->idcurso)
        ->where('actividades_alumnos.alumno_id', $this->idalumno)
        ->where('actividadtemas.tipoActividad', 2)
        ->select('actividadtemas.nombreActividad','cal_actividades.calificacion')
        ->get();
        
        $this->canPracAlumnos = count($practicas);
    }

    public function datosGrafica(){
        $actividades = DB::table('actividadtemas')
        ->where('actividadtemas.curso_id', $this->idcurso )
        ->where('actividadtemas.tipoActividad', 1)
        ->get();

        $this->canActividades = count($actividades);
        
        $this->faltantes = $this->canActividades - $this->canActAlumno; 
    }

    public function datosGraficaPracticas(){
        $practicas = DB::table('actividadtemas')
        ->where('actividadtemas.curso_id', $this->idcurso )
        ->where('actividadtemas.tipoActividad', 2)
        ->get();

        $this->canPracticas = count($practicas);
        
        $this->pracFaltantes = $this->canPracticas - $this->canPracAlumnos; 
    }

    public function getExamenes(){
        $this->listExamenes = DB::table('examencurso')
        ->where('curso_id', $this->idcurso)
        ->select('titulo', 'descripcion', 'idExamen')
        ->get();
    }
}
