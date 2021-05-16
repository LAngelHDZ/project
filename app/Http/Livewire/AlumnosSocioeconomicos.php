<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Alumnos;
use App\Models\Alumnos_datos;


class AlumnosSocioeconomicos extends Component
{

    public $alumno_id,$lugNac,$fechaNac,$genero,$estado_civil,$direccion,$colonia,$cp,$ciudad,$telefono,$curp,$num_seguro;
    public $tipo_sangre,$alergias,$medicamentos_alergicos,$complicaciones_medicas;
    public $dia, $mes, $year;
    public $nom_madre,$direccion_madre,$tel_madre,$colonia_madre,$nom_padre,$direccion_padre,$tel_padre,$colonia_padre;
    public $contacto,$telefono_contacto,$parentesco_contacto,$contacto2,$telefono_contacto2,$parentesco_contacto2; 
    public $message;
    
    protected $rules = [
        'lugNac' => 'required|string',
        'fechaNac' => 'required|string',
        'genero' => 'required|string',
        'estado_civil' => 'required|string',
        'direccion' => 'required|string',
        'colonia' => 'required|string',
        'cp' => 'required|string',
        'ciudad' => 'required|string',
        'telefono' => 'required|string',
        'curp' => 'required|string',
        'num_seguro' => 'required|string',
        'tipo_sangre' => 'required|string',
        'alergias' => 'required|string',
        'medicamentos_alergicos' => 'required|string',
        'complicaciones_medicas' => 'required|string',

        'nom_madre' => 'required|string',
        'direccion_madre' => 'required|string',
        'colonia_madre' => 'required|string',
        'tel_madre' => 'required|string',
        'nom_padre' => 'required|string',
        'direccion_padre' => 'required|string',
        'colonia_padre' => 'required|string',
        'tel_padre' => 'required|string',

        'contacto' => 'required|string',
        'telefono_contacto' => 'required|string',
        'parentesco_contacto' => 'required|string',
        'contacto2' => 'required|string',
        'telefono_contacto2' => 'required|string',
        'parentesco_contacto2' => 'required|string'
    ];

    public function render()
    {
        $this->obtenerDatos();
        return view('livewire.alumnos-socioeconomicos');
    }

    public function update(){
        $this->validate();

        Alumnos_datos::where('alumno_id', $this->alumno_id)
        ->update([
            'lugarNac' => $this->lugNac,
            'fechaNac' => $this->year.'/'.$this->mes.'/'.$this->dia,
            'genero' => $this->genero,
            'estado_civil' => $this->estado_civil,
            'direccion' => $this->direccion,
            'colonia' => $this->colonia, 
            'ciudad' => $this->ciudad,
            'telefono' => $this->telefono,
            'cp' => $this->cp,
            'curp' => $this->curp,
            'num_seguro' => $this->num_seguro,
            'tipo_sangre' => $this->tipo_sangre,
            'alergias' => $this->alergias,
            'medicamentos_alergicos' => $this->medicamentos_alergicos,
            'complicaciones_medicas' => $this->complicaciones_medicas,
            
            'nom_madre' => $this->nom_madre,
            'direccion_madre' => $this->direccion_madre,
            'colonia_madre' => $this->colonia_madre,
            'tel_madre' => $this->tel_madre,
            'nom_padre' => $this->nom_padre,
            'direccion_padre' => $this->direccion_padre,
            'colonia_padre' => $this->colonia_padre,
            'tel_padre' => $this->tel_padre,

            'contacto_emergencia' => $this->contacto,
            'tel_contacto' => $this->telefono_contacto,
            'parentesco' => $this->parentesco_contacto,
            'contacto_emergencia2' => $this->contacto2,
            'tel_contacto2' => $this->telefono_contacto2,
            'parentesco2' => $this->parentesco_contacto2
        ]);
    
        return $this->message = 'Guardado';  
    }

    public function obtenerDatos(){
        $idAlumno = Alumnos::where('user_id', Auth::user()->id )->first();
        $datosAlumno = Alumnos_datos::where('alumno_id', $idAlumno->idAlumno)->get();

        foreach($datosAlumno as $item){
            $this->lugNac = $item->lugarNac;
            $this->fechaNac = $item->fechaNac;
            $this->genero = $item->genero;
            $this->estado_civil = $item->estado_civil;
            $this->direccion = $item->direccion;
            $this->colonia = $item->colonia;
            $this->ciudad = $item->ciudad;
            $this->telefono = $item->telefono;
            $this->cp = $item->cp;
            $this->curp = $item->curp;
            $this->num_seguro = $item->num_seguro;
            $this->tipo_sangre = $item->tipo_sangre;
            $this->alergias = $item->alergias;
            $this->medicamentos_alergicos = $item->medicamentos_alergicos;
            $this->complicaciones_medicas = $item->complicaciones_medicas;

            $this->nom_madre = $item->nom_madre; 
            $this->direccion_madre = $item->direccion_madre;
            $this->colonia_madre = $item->colonia_madre;
            $this->tel_madre = $item->tel_madre;
            $this->nom_padre = $item->nom_padre;
            $this->direccion_padre = $item->direccion_padre;  
            $this->colonia_padre = $item->colonia_padre;
            $this->tel_padre = $item->tel_padre; 

            $this->contacto = $item->contacto_emergencia; 
            $this->telefono_contacto = $item->tel_contacto; 
            $this->parentesco_contacto = $item->parentesco ;
            $this->contacto2 = $item->contacto_emergencia2;
            $this->telefono_contacto2 = $item->tel_contacto2; 
            $this->parentesco_contacto2 = $item->parentesco2;

        }

        $date = Carbon::parse($this->fechaNac);
        $this->mes = $date->month;
        $this->dia = $date->day;
        $this->year = $date->year;
   
    }

}
