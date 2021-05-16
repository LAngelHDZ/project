<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\CalificacionUnidad;

class CalificarUnidades extends Component
{
    public $cursoId;
    public $listUnidades, $idUnidad, $listAlumnos; 
    public $idca, $calificacion;

    public function render()
    {
        $this->getUnidades();
        $this->getListAlumnos();
        return view('livewire.docentes.calificar-unidades');
    }

    public function getUnidades(){
        $this->listUnidades = DB::table('temas')
        ->join('materias', 'temas.materia_id', '=', 'materias.idMateria')
        ->join('curso', 'materias.idMateria', '=', 'curso.materia_id')
        ->where('curso.idCurso', $this->cursoId )
        ->where('temas.tipo', 1)
        ->select('temas.*')
        ->get();
    }

    protected $rules = [
        'calificacion' => 'required|integer|min:0|max:100',
    ];

    protected $messages = [
        'calificacion.min' => 'La puntuacion minima es 0',
        'calificacion.max' => 'La Calificacion maxima es 100',
        'calificacion.required' => 'Este campo es requerido',
    ];

    public function getListAlumnos(){
        $this->listAlumnos = DB::table('carga_academica')
        ->join('alumnos', 'carga_academica.alumno_id', '=', 'alumnos.idAlumno')
        ->join('users', 'alumnos.user_id', '=', 'users.id')
        ->leftJoin('calificacionparcial', 'carga_academica.idCA', '=', 'calificacionparcial.alumno_ins_id')
        ->select('users.name', 'users.lastname', 'alumnos.nControl', 'alumnos.semestre', 'carga_academica.*')
        ->where('carga_academica.curso_id', $this->cursoId)
        ->get();
    }

    public function storeCalificacion(){
        $this->validate();

        $verificacion = DB::table('calificacionparcial')
        ->where('calificacionparcial.unidad_id',$this->idUnidad)
        ->where('calificacionparcial.alumno_ins_id',$this->idca)
        ->count();

        if($verificacion == 1){
            $this->dispatchBrowserEvent('calificacionExiste');
            return;
        }
        
        $calUnidad = new CalificacionUnidad;
        $calUnidad->calificacion = $this->calificacion;
        $calUnidad->unidad_id = $this->idUnidad;
        $calUnidad->alumno_ins_id = $this->idca;
        $calUnidad->save();

        $this->closeShowModal(); 
    }

    public function showModal($idca){
        $this->idca = $idca;
        $this->dispatchBrowserEvent('modalCalificacion');
    }

    public function closeShowModal(){
        $this->calificacion = 0;
        $this->idca = 0;

        $this->dispatchBrowserEvent('closeModalCalficaciones');
    }

    public function cancelShowModal(){
        $this->dispatchBrowserEvent('cancelModalCalificaciones');
    }

    public function cancelarCalificacion(){   
        $this->calificacion = 0;
        $this->idca = 0;

        $this->cancelShowModal(); 
    }
}
