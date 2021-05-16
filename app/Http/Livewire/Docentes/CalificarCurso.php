<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\CalificacionFInal;

class CalificarCurso extends Component
{
    public $cursoId;
    public $listAlumnos, $calificacion, $idAlumno;

    public function render()
    {
        $this->getListAlumnos();
        return view('livewire.docentes.calificar-curso');
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
        ->leftJoin('calificacionfinal', 'carga_academica.idCA', '=', 'calificacionfinal.alumno_ins_id')
        ->select('users.name', 'users.lastname', 'alumnos.nControl', 'alumnos.semestre', 'carga_academica.*',DB::raw('case when calificacionfinal.alumno_ins_id IS NULL then 0 ELSE 1 END AS calificado'))
        ->where('carga_academica.curso_id', $this->cursoId)
        ->get();
    }

    public function storeCalificacionFinal(){
        $this->validate();

        $calificacionFinal = new CalificacionFInal;
        $calificacionFinal->calificacion = $this->calificacion;
        $calificacionFinal->alumno_ins_id = $this->idAlumno;
        $calificacionFinal->save();

        $this->closeShowModal();
    }

    public function showModal($idalumno){
        $this->idAlumno = $idalumno;
        $this->dispatchBrowserEvent('modalCalificacion');
    }

    public function closeShowModal(){
        $this->calificacion = 0;
        $this->idAlumno = 0;

        $this->dispatchBrowserEvent('closeModalCalficaciones');
    }

    public function cancelShowModal(){
        $this->dispatchBrowserEvent('cancelModalCalificaciones');
    }

    public function cancelarCalificacion(){   
        $this->calificacion = 0;
        $this->idAlumno = 0;

        $this->cancelShowModal(); 
    }
}
