<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Docente;
use Carbon\Carbon;
use App\Models\Docente_datos;

class DatosSocieconomicos extends Component
{
    public $lugarNac, $fechaNac, $estado_civil, $genero;
    public $dia, $mes, $year;
    public $idDatos, $direccion, $colonia, $ciudad, $telefono, $cp, $curp, $numSeguro, $tipo_sangre;
    public $alergias, $medAlergias, $compliMedicas, $contacto, $tel1, $parentesco1, $contacto2, $tel2, $parentesco2, $message;

    protected $rules = [
        'lugarNac' => 'required|string',
        'fechaNac' => 'required|string',
        'estado_civil' => 'required|string',
        'genero' => 'required|string',
        'direccion' => 'required|string',
        'colonia' => 'required|string',
        'ciudad' => 'required|string',
        'telefono' => 'required|string',
        'cp' => 'required|string',
        'curp' => 'required|string',
        'numSeguro' => 'required|string',
        'tipo_sangre' => 'required|string',
        'alergias' => 'required|string',
        'medAlergias' => 'required|string',
        'compliMedicas' => 'required|string',
        'contacto' => 'required|string',
        'parentesco1' => 'required|string',
        'tel1' => 'required|string',
        'contacto2' => 'required|string',
        'parentesco2' => 'required|string',
        'tel2' => 'required|string',
    ];

    public function render()
    {
        $this->obtenerDatos();

        return view('livewire.datos-socieconomicos');
    }

    public function update(){

        $this->validate();
        
        Docente_datos::where('docente_id', $this->idDatos)
        ->update([
            'lugarNac' => $this->lugarNac,
            'fechaNac' => $this->year.'/'.$this->mes.'/'.$this->dia,
            'estado_civil' => $this->estado_civil,
            'genero' => $this->genero,
            'direccion' => $this->direccion,
            'colonia' => $this->colonia,
            'ciudad' => $this->ciudad,
            'telefono' => $this->telefono,
            'cp' => $this->cp,
            'curp' => $this->curp,
            'num_seguro' => $this->numSeguro,
            'tipo_sangre' => $this->tipo_sangre,
            'alergias' => $this->alergias,
            'medicamentos_alergicos' => $this->medAlergias,
            'complicaciones_medicas' => $this->compliMedicas,
            'contacto_emerg' => $this->contacto,
            'tel_contacto' => $this->tel1,
            'parentesco' => $this->parentesco1,
            'contacto_emerg2' => $this->contacto2,
            'tel_contacto2' => $this->tel2,
            'parentesco2' => $this->parentesco2
        ]);
    
        return $this->message = 'Guardado';  
    }

    public function obtenerDatos(){
        $idDocente = Docente::where('user_id', Auth::user()->id )->first();
        $datosDocente = Docente_datos::where('docente_id', $idDocente->idDocente)->get();

        ///$this->data = $datosDocente;

        foreach($datosDocente as $item){
            $this->idDatos = $item->docente_id;
            $this->lugarNac = $item->lugarNac;
            $this->fechaNac = $item->fechaNac;
            $this->genero = $item->genero;
            $this->estado_civil = $item->estado_civil;
            $this->direccion = $item->direccion;
            $this->colonia = $item->colonia;
            $this->ciudad = $item->ciudad;
            $this->telefono = $item->telefono;
            $this->cp = $item->cp;
            $this->curp = $item->curp;
            $this->numSeguro = $item->num_seguro;
            $this->tipo_sangre = $item->tipo_sangre;
            $this->alergias = $item->alergias;
            $this->medAlergias = $item->medicamentos_alergicos;
            $this->compliMedicas = $item->complicaciones_medicas;
            $this->contacto = $item->contacto_emerg;
            $this->tel1 = $item->tel_contacto;
            $this->parentesco1 = $item->parentesco;
            $this->contacto2 = $item->contacto_emerg2;
            $this->tel2 = $item->tel_contacto2;
            $this->parentesco2 = $item->parentesco2;   
        }
        $date = Carbon::parse($this->fechaNac);
        $this->mes = $date->month;
        $this->dia = $date->day;
        $this->year = $date->year;
    }

}
