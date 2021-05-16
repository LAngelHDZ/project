<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use App\Models\RespuestasPreguntas;
use Illuminate\Support\Facades\DB;

class RespuestasExamen extends Component
{
    public $preguntaId;
    public $listRespuestas;

    public function render()
    {
        $this->getRespuestas();
        return view('livewire.docentes.respuestas-examen');
    }

    public function getRespuestas(){

        $this->listRespuestas = DB::table('respuestas_preguntas')
        ->select('respuestas_preguntas.*')
        ->where('respuestas_preguntas.pregunta_id', $this->preguntaId)
        ->get();
    }
}
