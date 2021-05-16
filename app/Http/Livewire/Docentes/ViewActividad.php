<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Actividades;
Use App\Models\Rubrica;

class ViewActividad extends Component
{
    use WithFileUploads;
    public $idactividad, $actividad;
    public $recursoOld, $listSemanas;
    public $nombreActividad, $descripcion, $fechainicio, $fechafin, $tema_id, $curso_id, $recursoNew, $semanaEdt, $porcentaje; 
    public $listRubrica, $criterio, $desCriterio, $puntRubrica, $idRubrica;
    public $editCriterio, $editDesCriterio, $editPuntRubrica;

    public function render()
    {
        $this->getActividad(); 
        $this->cargarSemanas();
        $this->getRubrica();
        return view('livewire.docentes.view-actividad');
    }

    public function getActividad(){
        $this->actividad = DB::table('actividadtemas')
        ->where('idActividadTemas', $this->idactividad)
        ->get();

        foreach ($this->actividad as $item) {
            # code...
            $this->nombreActividad = $item->nombreActividad;
            $this->descripcion = $item->descripcionActividad;
            $this->recursoOld = $item->recursos;
            $this->fechainicio = $item->fechainicio;
            $this->fechafin = $item->fechalimite;
            $this->tema_id = $item->temas_id;
            $this->curso_id = $item->curso_id;
            $this->semanaEdt = $item->semana_id;  
            $this->porcentaje = $item->porcentajeCurso;
        }
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

        $this->listSemanas = DB::table('semanas')
        ->select('semanas.finicio','semanas.ffinal', 'semanas.idSemanas')
        ->where('semanas.periodo_id', $periodoId->idPeriodo)
        ->get();
    }

    public function getURLRecurso($recurso){
        //$extension = $this->recursoOld->file('public')->extension();
        //return Storage::download($recurso, 'document.'.$extension);
        return Storage::download($recurso);
    }

    public function updatedActividad(){
        if($this->recursoNew == null){
            Actividades::where('idActividadTemas', $this->idactividad)
            ->where('temas_id', $this->tema_id)
            ->where('curso_id', $this->curso_id)
            ->update([
                'nombreActividad' => $this->nombreActividad,
                'descripcionActividad' => $this->descripcion, 
                'fechainicio' => $this->fechainicio,
                'fechalimite' => $this->fechafin,
                'porcentajeCurso' => $this->porcentaje,
            ]);

            session()->flash('message', 'Actividad modificada con exito!.');
        }else{

            $this->validate([
                'recursoNew' => 'max:25600', // 25MB Max
                'recursoNew.max' => 'Tamaño maximo de archivo es de 25MB.'
            ]);

            //$delete = Storage::delete($this->recursoOld);
            $delete = Storage::disk('local')->delete($this->recursoOld);

            Actividades::where('idActividadTemas', $this->idactividad)
            ->where('temas_id', $this->tema_id)
            ->where('curso_id', $this->curso_id)
            ->update([
                'nombreActividad' => $this->nombreActividad,
                'descripcionActividad' => $this->descripcion, 
                'recursos' => $this->recursoNew->store('public'),
                'fechainicio' => $this->fechainicio,
                'fechalimite' => $this->fechafin,
                'porcentajeCurso' => $this->porcentaje,
            ]);
            $this->recursoNew = null;
            session()->flash('message', 'Actividad modificada con exito!.');
        }
        $this->getActividad();
    }

    //TODO: metodos para la rubrica
    public function storeRubrica(){

        $validatedData = $this->validate(
            [
                'criterio' => 'required|string',
                'puntRubrica' => 'required|integer',
                'desCriterio' => 'required|string',
            ],
            [
                'criterio.required' => 'Este campo es necesario.',
                'desCriterio.required' => 'Este campo es necesario.',
                'puntRubrica.required' => 'Este campo es necesario.',
                'puntRubrica.integer' => 'Debe ser un numero entero.'
            ]
        );

        $rubrica = new Rubrica();
        $rubrica->criterio = $this->criterio;
        $rubrica->descripcion = $this->desCriterio;
        $rubrica->puntuacion = $this->puntRubrica;
        $rubrica->actividad_id = $this->idactividad;
        $rubrica->save();  

        $this->criterio = '';
        $this->desCriterio = '';
        $this->puntRubrica = 0;
    }

    public function showModal($idrub, $cri, $des, $punt){
        $this->idRubrica = $idrub;
        $this->editCriterio = $cri;
        $this->editDesCriterio = $des;
        $this->editPuntRubrica = $punt;

        $this->dispatchBrowserEvent('modalRubrica');
        
    }

    public function cancelRubrica(){
        $this->clear();
        $this->dispatchBrowserEvent('cancelarModalRubrica');
    }

    public function closeRubrica(){
        $this->clear();
        $this->dispatchBrowserEvent('closeModalRubrica');
    }

    public function clear(){
        $this->idRubrica = 0;
        $this->editCriterio = '';
        $this->editDesCriterio = '';
        $this->editPuntRubrica = 0;
    }

    public function updatedRubrica(){
        $validatedData = $this->validate(
            [
                'editCriterio' => 'required|string',
                'editPuntRubrica' => 'required|integer',
                'editDesCriterio' => 'required|string',
            ],
            [
                'editCriterio.required' => 'Este campo es necesario.',
                'editDesCriterio.required' => 'Este campo es necesario.',
                'editPuntRubrica.required' => 'Este campo es necesario.',
                'editPuntRubrica.integer' => 'Debe ser un numero entero.'
            ]
        );

        Rubrica::where('idRubricaActividad', $this->idRubrica)
        ->where('actividad_id', $this->idactividad)
        ->update([
            'criterio' => $this->editCriterio,
            'descripcion' => $this->editDesCriterio,
            'puntuacion' => $this->editPuntRubrica,
        ]);

        $this->closeRubrica();
    }

    public function getRubrica(){
        $this->listRubrica = DB::table('rubricaActividad')
        ->select('rubricaActividad.*')
        ->where('rubricaActividad.actividad_id', $this->idactividad)
        ->get();
    }

}
