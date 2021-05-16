<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Actividades;
use Illuminate\Support\Facades\DB;


class FormActividades extends Component
{
    use WithFileUploads;
    public $curso, $tema;
    public $nombreActividad, $descripcionActividad, $fechaInicio, $fechaLimite, $recurso, $semanaAct, $tipoActividad, $porcentaje=1;
    public $showfile = true;
    public $semanas;

    protected $rules = [
        'nombreActividad' => 'required|string',
        'descripcionActividad' => 'required|string',
        'fechaInicio' => 'required|date',
        'fechaLimite' => 'required|date',
        'semanaAct' => 'required|integer',
        'porcentaje' => 'required|integer|min:0|max:100',
        'tipoActividad' => 'required'
        //'puntuacion' => 'required|integer|min:0|max:100'
    ]; 

    protected $messages = [
        'nombreActividad.required' => 'Este campo es requerido.',
        'descripcionActividad.required' => 'Este campo es requerido.',
        'fechaInicio.required' => 'Este campo es requerido.',
        'fechaLimite.required' => 'Este campo es requerido.',
        'semanaAct.required' => 'Este campo es requerido.',
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
        $this->cargarSemanas();
        return view('livewire.docentes.form-actividades');
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
            $actividad->temas_id = $this->tema;
            $actividad->curso_id = $this->curso;
            $actividad->semana_id = $this->semanaAct;
            $actividad->save();

            session()->flash('message', 'La actividad fue agregada.');

            return redirect()->route('cursos_docentes.show',$this->curso);

        }
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
        $actividad->temas_id = $this->tema;
        $actividad->curso_id = $this->curso;
        $actividad->semana_id = $this->semanaAct;
        $actividad->save();

        session()->flash('message', 'La actividad fue agregada.');

        return redirect()->route('cursos_docentes.show',$this->curso);
    }

}
