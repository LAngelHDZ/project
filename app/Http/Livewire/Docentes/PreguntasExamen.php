<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use App\Models\RespuestasPreguntas;
use App\Models\Preguntas;
use Illuminate\Support\Facades\DB;

class PreguntasExamen extends Component
{
    public $examenId;
    public $pregunta, $tipoPregunta, $puntosPregunta, $idPregunta;
    public $preguntaEdit, $puntosPreguntaEdit, $idPreguntaEdit;
    public $respuesta, $iscorrect;
    public $listPreguntas, $listRespuestas;
    public $idRespuestaEdit, $respuestaEdit, $isCorrectEdit, $preguntaIdEdit;

    public function render()
    {
        $this->getPreguntas();
        return view('livewire.docentes.preguntas-examen');
    }

    public function storePreguntas(){
        $validatedData = $this->validate(
            [
                'pregunta' => 'required|string',
                'tipoPregunta' => 'required|integer',
                'puntosPregunta' => 'required|integer',
            ],
            [
                'pregunta.required' => 'Este campo es necesario.',
                'tipoPregunta.required' => 'Este campo es necesario.',
                'puntosPregunta.required' => 'Este campo es necesario.'
            ]
        );

        $pregunta = new Preguntas();
        $pregunta->pregunta = $this->pregunta;
        $pregunta->tipo = $this->tipoPregunta;
        $pregunta->puntos = $this->puntosPregunta;
        $pregunta->examen_id = $this->examenId;
        $pregunta->save();

        $this->clearPreguntas();
    }

    public function storeRespuestas(){
        $validation = $this->validate(
            [
                'respuesta' => 'required|string',
                'iscorrect' => 'required|integer'
            ],
            [
                'respueta.required' => 'Este campo es necesario',
                'iscorrect.required' => 'Este campo es necesario' 
            ]
        );

        $respuesta = new RespuestasPreguntas();
        $respuesta->respuesta = $this->respuesta;
        $respuesta->rcorrecta = $this->iscorrect;
        $respuesta->pregunta_id = $this->idPregunta;
        $respuesta->save();  
        
        $this->clearRespuetas();
        $this->closeShowModal();
    }

    public function clearPreguntas(){
        $this->pregunta = "";
        $this->tipoPregunta = 1; 
        $this->puntosPregunta = 1;
    }

    public function clearRespuetas(){
        $this->respuestas = "";
        $this->rcorrect = 0; 
    }

    public function getPreguntas(){
        $this->listPreguntas = DB::table('preguntas_examen')
        ->select('preguntas_examen.*')
        ->where('preguntas_examen.examen_id', $this->examenId )
        ->get();

        /*$this->listPreguntas = DB::table('preguntas_examen')
        ->join('respuestas_preguntas', 'preguntas_examen.idPregunta', '=', 'respuestas_preguntas.pregunta_id')
        ->select('preguntas_examen.*', 'respuestas_preguntas.*')
        ->where('preguntas_examen.examen_id', $this->examenId )
        ->get();*/
    }

    public function showModal($idpregunta){
        $this->idPregunta = $idpregunta;
        $this->respuesta = "";
        $this->iscorrect = 0;
        $this->dispatchBrowserEvent('modalRespuesta');
    }

    public function closeShowModal(){
        $this->dispatchBrowserEvent('closeModalRespuestas');
    }

    public function showModalEditPreguntas($idpregunta, $pregunta, $puntos){
        $this->preguntaEdit = $pregunta;
        $this->puntosPreguntaEdit = $puntos;
        $this->idPreguntaEdit = $idpregunta;

        $this->dispatchBrowserEvent('modalPreguntaEdit');
    }

    public function closeShowModalEditPreguntas(){
        $this->dispatchBrowserEvent('closeModalPreguntaEdit');
    }

    public function showModalEditRespuestas($idrespuesta, $respuesta, $correct, $preguntaId){
        $this->idRespuestaEdit = $idrespuesta;
        $this->respuestaEdit = $respuesta;
        $this->isCorrectEdit = $correct;
        $this->preguntaIdEdit = $preguntaId;

        $this->dispatchBrowserEvent('modalRespuestasEdit');
    }

    public function closeShowModalEditRespuestas(){
        $this->dispatchBrowserEvent('closeModalRespuestasEdit');
    }

    public function getRespuestas($identificador){
        $respuestas = DB::table('respuestas_preguntas')
        ->select('respuestas_preguntas.*')
        ->where('respuestas_preguntas.pregunta_id', $identificador)
        ->get();

        return $respuestas;
    }

    public function updatePreguntas(){
        $validation = $this->validate(
            [
                'preguntaEdit' => 'required|string',
                'puntosPreguntaEdit' => 'required|integer',
                'idPreguntaEdit' => 'required|integer'
            ],
            [
                'preguntaEdit.required' => 'Este campo es necesario',
                'puntosPreguntaEdit.required' => 'Este campo es necesario',
                'idPreguntaEdit.required' => 'Este campo es necesario'
            ]
        );

        Preguntas::where('preguntas_examen.idPregunta', $this->idPreguntaEdit )
        ->where('preguntas_examen.examen_id', $this->examenId )
        ->update([
            'pregunta' => $this->preguntaEdit,
            'puntos' => $this->puntosPreguntaEdit
        ]);

        $this->closeShowModalEditPreguntas();
    }

    public function updateRespuesta(){
        $validation = $this->validate(
            [
                'respuestaEdit' => 'required|string',
            ],
            [
                'respuestaEdit.required' => 'Este campo es necesario',
            ]
        );

        RespuestasPreguntas::where('idRespuesta', $this->idRespuestaEdit)
        ->where('pregunta_id', $this->preguntaIdEdit )
        ->update([
            "respuesta" => $this->respuestaEdit,
            "rcorrecta" => $this->isCorrectEdit, 
        ]);

        $this->closeShowModalEditRespuestas();
    }
}
