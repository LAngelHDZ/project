<?php

namespace App\Http\Livewire\Alumnos;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\ActividadAlumnos;

class ViewActividad extends Component
{
    use WithFileUploads;

    public $idactividad, $actividad, $verificacionActividad, $fechaLimite, $fechaNow;
    public $archivoactividad, $path, $calificacion, $listRubrica;
    public $response;

    public function render()
    {
        $this->getActividad(); 
        $this->verificarActividad();
        $this->getCalificacion();
        $this->getRubrica();
        return view('livewire.alumnos.view-actividad');
    }

    protected $rules = [
        'archivoactividad' => 'required|max:25600',
    ];

    protected $messages = [
        'archivoactividad.required' => 'Es ncesario agregar un documento.',
    ];

    public function mount()
    {
        //$this->getActividad();
    }

    public function getActividad(){
        $this->actividad = DB::table('actividadtemas')
        ->where('idActividadTemas', $this->idactividad)
        ->get();

        foreach($this->actividad as $item){
            $this->fechaLimite = $item->fechalimite;  
        }


        $this->fechaNow = date('Y-m-d');
    }

    public function verificarActividad(){
        $idAlumno = DB::table('alumnos')->where('user_id', Auth::id())->first();

        $this->verificacionActividad = DB::table('actividades_alumnos')
        ->where('alumno_id', $idAlumno->idAlumno)
        ->where('actividad_id', $this->idactividad)
        ->count();
    }

    public function storeActividad(){
        //$validatedData = $this->validate();
        $validatedData = $this->validate(
            ['archivoactividad' => 'required|max:25600'],
            [
                'archivoactividad.required' => 'Es necesario agregar un archivo.',
                'archivoactividad.max' => 'Tamaño maximo de documento 25MB.',
            ]
        );

        $actividadValidation = DB::table('actividadtemas')
        ->where('idActividadTemas', $this->idactividad)
        ->first();

        $idAlumno = DB::table('alumnos')->where('user_id', Auth::id())->first();

        $date = date('Y-m-d');
        $dateLimite = date($actividadValidation->fechalimite);
        $time = date('H:i:s');

        if($date <= $dateLimite){
            
            $alumnos = new ActividadAlumnos;
            $alumnos->archivo = $this->archivoactividad->store('public'); 
            $alumnos->fechaEntrega = $date;
            $alumnos->hora = $time;
            $alumnos->actividad_id = $this->idactividad;
            $alumnos->alumno_id = $idAlumno->idAlumno;
            $alumnos->save();

            $this->response = 'ok';
        }else{
            $this->response = 'se te va el tren araña'; 
        }  
    }

    public function downloadRecurso($recursos){
        //$this->name = $recursos;
        //return response()->download(storage_path($recursos));
        //return Storage::download($recursos);
        return Storage::download($recursos);
    }

    public function getCalificacion(){
        $idAlumno = DB::table('alumnos')->where('user_id', Auth::id())->first();

        $this->calificacion = DB::table('actividades_alumnos')
        ->join('cal_actividades', 'actividades_alumnos.idActividadAlumno','=','cal_actividades.tarea_id')
        ->select('cal_actividades.calificacion','cal_actividades.comentarios')
        ->where('actividades_alumnos.actividad_id', $this->idactividad)
        ->where('actividades_alumnos.alumno_id', $idAlumno->idAlumno)
        ->get();
    }

    public function getRubrica(){
        $this->listRubrica = DB::table('rubricaactividad')
        ->select('rubricaactividad.*')
        ->where('rubricaactividad.actividad_id', $this->idactividad )
        ->get();
    }
}
