<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Actividades;
use App\Models\Cursos;
use Illuminate\Support\Facades\DB;


class FormActividades extends Component
{
    use WithFileUploads;
    public $curso, $idtype,$type;
    public $nombreActividad, $descripcionActividad, $fechaInicio, $fechaLimite, $recurso, $idformtype, $tipoActividad, $porcentaje=1;
    public $showfile = true;
    public $semanas, $temas;

    protected $rules = [
        'nombreActividad' => 'required|string',
        'descripcionActividad' => 'required|string',
        'fechaInicio' => 'required|date',
        'fechaLimite' => 'required|date',
        'idformtype' => 'required|integer',
        'porcentaje' => 'required|integer|min:0|max:100',
        'tipoActividad' => 'required'
        //'puntuacion' => 'required|integer|min:0|max:100'
    ]; 

    protected $messages = [
        'nombreActividad.required' => 'Este campo es requerido.',
        'descripcionActividad.required' => 'Este campo es requerido.',
        'fechaInicio.required' => 'Este campo es requerido.',
        'fechaLimite.required' => 'Este campo es requerido.',
        'idformtype.required' => 'Este campo es requerido.',
        'tipoActividad.required' => 'Este campo es requerido.',
        'porcentaje.required' => 'Este campo es requerido.',
        'porcentaje.min' => 'El valor minimo es 1',
        'procentaje.max' => 'El valor maximo es 100'
        
        //'puntuacion.required' => 'Este campo es requerido',
        //'puntuacion.min' => 'El valor minimo es 0',
        //'puntuacion.max' => 'El valor maximo es 100'
    ];

    public function render()
    {

        if($this->type==0){
            $this->cargarSemanas();
        }else{
            $this->cargatemas();
        }
        
        return view('livewire.docentes.form-actividades');
    }

    public function cargatemas(){

        $idMateria=Cursos::where('idCurso',$this->curso)->get();
        $this->temas = DB::table('temas')
        ->leftJoin('actividadtemas', 'temas.idTema', '=', 'actividadtemas.temas_id')
        ->where('temas.materia_id', $idMateria[0]->materia_id)
        ->select('temas.*','actividadtemas.idActividadTemas',DB::raw('case when actividadtemas.temas_id IS NULL then 0 ELSE 1 END AS cantAct'))
        ->orderBy('temas.indice', 'asc')
        ->get(); 



    }
    public function cargarSemanas(){
        $year = date('Y');
        $mes = date('m');

        if($mes < 6){
            $periodo = 'Enero-Junio';
        }else if($mes > 6){
            $periodo = 'Agosto-Diciembre';
        }else{
            $periodo = 'Verano';
        }
        $periodoId = DB::table('periodo')
        ->where('periodo', $periodo)
        ->where('year', $year)
        ->first();

        $this->semanas = DB::table('semanas')
        ->select('semanas.finicio','semanas.ffinal', 'semanas.idSemanas')
        ->where('semanas.periodo_id', $periodoId->idPeriodo)
        ->get();
    }

    public function actividadStore(){

        $this->validate();

        if($this->type==0){
            $this->temas=$this->idtype;
            $this->semanas=$this->idformtype;
        }else{
            $this->semanas=$this->idtype;
            $this->temas=$this->idformtype;

        }

        if($this->recurso == null ){

            $actividad = new Actividades;
            $actividad->nombreActividad = $this->nombreActividad;
            $actividad->descripcionActividad = $this->descripcionActividad;
            $actividad->recursos = '';
            $actividad->tipoActividad =  $this->tipoActividad; 
            $actividad->porcentajeCurso = $this->porcentaje;
            //$actividad->puntuacion = $this->puntuacion;
            $actividad->fechainicio = $this->fechaInicio;
            $actividad->fechalimite = $this->fechaLimite;
            $actividad->temas_id = $this->temas;
            $actividad->curso_id = $this->curso;
            $actividad->semana_id = $this->semanas;
            $actividad->save();
        }
        else{

            $this->validate([
                'recurso' => 'max:25600', // 25MB Max
                'recurso.max' => 'Tamaño maximo de archivo es de 25MB.'
            ]);
    
            $actividad = new Actividades;
            $actividad->nombreActividad = $this->nombreActividad;
            $actividad->descripcionActividad = $this->descripcionActividad;
            $actividad->recursos = $this->recurso->store('public'); 
            $actividad->tipoActividad = $this->tipoActividad;  
            $actividad->porcentajeCurso = $this->porcentaje;
            //$actividad->puntuacion = $this->puntuacion;
            $actividad->fechainicio = $this->fechaInicio;
            $actividad->fechalimite = $this->fechaLimite;
            $actividad->temas_id = $this->temas;
            $actividad->curso_id = $this->curso;
            $actividad->semana_id = $this->semanas;
            $actividad->save();
        }
       

        session()->flash('message', 'La actividad fue agregada.');

        return redirect()->route('cursos_docentes.show',$this->curso);
    }
}