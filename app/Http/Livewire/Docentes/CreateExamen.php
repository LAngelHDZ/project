<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use App\Models\Examen;
use Illuminate\Support\Facades\DB;

class CreateExamen extends Component
{
    public $cursoId;
    public $titulo, $descripcion, $fechaApertura, $horaApertura, $fechaLimite, $horaLimite, $listExamen;
    public $tituloEdit, $descripcionEdit, $fechaAperturaEdit, $horaAperturaEdit, $fechaLimiteEdit, $horaLimiteEdit, $idExamenEdit;

    public function render()
    {
        $this->getExamenes();
        return view('livewire.docentes.create-examen');
    }

    protected $rules = [
        'titulo' => 'required|string',
        'descripcion' => 'required|string',
        'fechaApertura' => 'required|date',
        'horaApertura' => 'required',
        'fechaLimite' => 'required|date',
        'horaLimite' => 'required',
    ];

    protected $messages = [
        'titulo.required' => 'Este campo es necesario',
        'descripcion.required' => 'Este campo es necesario',
        'fechaApertura.required' => 'Este campo es necesario',
        'horaApertura.required' => 'Este campo es necesario',
        'fechaLimite.required' => 'Este campo es necesario',
        'horaLimite.required' => 'Este campo es necesario',
    ];

    public function storeExamen(){
        $this->validate();

        $examen = new Examen();
        $examen->titulo = $this->titulo;
        $examen->descripcion = $this->descripcion;
        $examen->fecha_apertura = $this->fechaApertura;
        $examen->hora_apertura = $this->horaApertura;
        $examen->fechalimite = $this->fechaLimite;
        $examen->horalimite = $this->horaLimite;
        $examen->curso_id = $this->cursoId;
        $examen->save();

        $this->clear();
    }

    public function getExamenes(){
        $this->listExamen = DB::table('examencurso')
        ->select('examencurso.*')
        ->where('examencurso.curso_id', $this->cursoId)
        ->get();
    }

    public function clear(){
        $this->titulo =""; 
        $this->descripcion=""; 
        $this->fechaApertura=""; 
        $this->horaApertura="";
        $this->fechaLimite=""; 
        $this->horaLimite="";
    }

    public function showModal($idexamen, $titulo, $des, $fechaAper, $horaAper, $fechaLim, $horaLimit){
        $this->tituloEdit = $titulo; 
        $this->descripcionEdit = $des;
        $this->fechaAperturaEdit = $fechaAper;
        $this->horaAperturaEdit = $horaAper;
        $this->fechaLimiteEdit = $fechaLim;
        $this->horaLimiteEdit = $horaLimit; 
        $this->idExamenEdit = $idexamen;

        $this->dispatchBrowserEvent('modalExamen');
    }

    public function closeShowModal(){
        $this->dispatchBrowserEvent('closeModalExamen');
    }

    public function updateExamen(){
        $validation = $this->validate(
            [
                'tituloEdit' => 'required|string',
                'descripcionEdit' => 'required|string',
                'fechaAperturaEdit' => 'required|date',
                'horaAperturaEdit' => 'required',
                'fechaLimiteEdit' => 'required|date',
                'horaLimiteEdit' => 'required',
            ],
            [
                'tituloEdit.required' => 'Este campo es necesario',
                'descripcionEdit.required' => 'Este campo es necesario',
                'fechaAperturaEdit.required' => 'Este campo es necesario',
                'horaAperturaEdit.required' => 'Este campo es necesario',
                'fechaLimiteEdit.required' => 'Este campo es necesario',
                'horaLimiteEdit.required' => 'Este campo es necesario'
            ]
        );

        $editExamen = Examen::where('idExamen', $this->idExamenEdit)
        ->where('curso_id', $this->cursoId)
        ->update([
            'titulo' => $this->tituloEdit,
            'descripcion' => $this->descripcionEdit,
            'fecha_apertura' => $this->fechaAperturaEdit,
            'hora_apertura' => $this->horaAperturaEdit,
            'fechalimite' => $this->fechaLimiteEdit,
            'horalimite' => $this->horaLimiteEdit, 
        ]);

        $this->closeShowModal(); 


    }
}
