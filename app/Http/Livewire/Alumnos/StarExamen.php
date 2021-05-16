<?php

namespace App\Http\Livewire\Alumnos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\ExamenAlumno;

class RespuetasAlumno {
    public $pregunta;
    public $respuesta = [];

    public function __construc($pregunta, $respuesta){
        $this->pregunta = $pregunta;
        $this->respuesta = $respuesta;
    }
}

class StarExamen extends Component
{
    public $idExamen;
    public $listPreguntas, $examen, $iteracion=0, $arrayPreguntas, $horaLimiteExamen, $mensaje, $bloqueo, $showExamen=true;
    public $respuestaAlumno = [], $respuestaText;

    public function render()
    {
        $this->getPreguntasExamen();
        $this->getExamen();
        return view('livewire.alumnos.star-examen');
    }

    public function getExamen(){
        $this->examen = DB::table('examencurso')
        ->select('titulo', 'descripcion', 'fechalimite', 'horalimite')
        ->where('idExamen', $this->idExamen )
        ->get();

        $hora = DB::table('examencurso')->select('horalimite')->where('idExamen', $this->idExamen)->first();
        $this->horaLimiteExamen = $hora->horalimite; 
    }


    public function getPreguntasExamen(){
        /*$this->listPreguntas = DB::table('preguntas_examen')
        ->select('idPregunta', 'pregunta', 'tipo', 'puntos' )
        ->where('preguntas_examen.examen_id', $this->idExamen )
        ->get();*/

        //query for select all questions
        $this->listPreguntas = DB::table('preguntas_examen')
        ->where('preguntas_examen.examen_id', $this->idExamen )
        ->whereNotExists(function($query){
            $query->select(DB::raw(1))
            ->from('examen_alumno')
            ->whereColumn('examen_alumno.pregunta_id', 'preguntas_examen.idPregunta');
        })
        ->select('idPregunta', 'pregunta', 'tipo', 'puntos')
        ->get();

        /*TODO::no funciono el codigo
        $pregunta = new PreguntasExamen();
        $this->arrayPreguntas = array($this->listPreguntas);*/
        
        /*foreach ($this->listPreguntas as $item) {
            # code...
            $pregunta->__construc($item->idPregunta,$item->pregunta, $item->tipo, $item->puntos );
            array_push($this->arrayPreguntas, $pregunta);
        }*/

        /*$this->listPreguntas = DB::table('preguntas_examen')
        ->join('respuestas_preguntas', 'preguntas_examen.idPregunta', '=', 'respuestas_preguntas.pregunta_id')
        ->select('preguntas_examen.*', 'respuestas_preguntas.idRespuesta', 'respuestas_preguntas.respuesta')
        ->where('preguntas_examen.examen_id', $this->idExamen )
        ->get();*/
    }

    public function getRespuestasPregunta($idPregunta){
        return DB::table('respuestas_preguntas')
        ->select('idRespuesta', 'respuesta')
        ->where('pregunta_id', $idPregunta)
        ->get();
    }

    public function saveAndNext($idPregunta, $tipo, $ultimo){
        $horaNow = date('H:i:s');

        if($horaNow < $this->horaLimiteExamen){
            $idalumno = DB::table('alumnos')->select('idAlumno')->where('user_id', Auth::id())->first();
            $idCargaAcademica = DB::table('carga_academica')->select('idCA')->where('alumno_id',$idalumno->idAlumno)->first();

            if($tipo == 1){

                $validation = $this->validate(
                    [
                        'respuestaText' => 'required|string',
                    ],
                    [
                        'respuestaText.required' => 'Este campo es necesario',
                    ]
                );
                
                $examenAlumno = new ExamenAlumno();
                $examenAlumno->examen_id = $this->idExamen;
                $examenAlumno->pregunta_id = $idPregunta;
                $examenAlumno->alumno_ca_id = $idCargaAcademica->idCA;
                $examenAlumno->respuestas = $this->respuestaText;
                $examenAlumno->save();

                $this->respuestaText = "";
            }else{

                $validation = $this->validate(
                    [
                        'respuestaAlumno' => 'required',
                    ],
                    [
                        'respuestaAlumno.required' => 'Seleccione al menos una opcion',
                    ]
                );

                $respuesta = implode(",",$this->respuestaAlumno); //TODO::usar explode para obtener el array de vuelta

                $examenAlumno = new ExamenAlumno();
                $examenAlumno->examen_id = $this->idExamen;
                $examenAlumno->pregunta_id = $idPregunta;
                $examenAlumno->alumno_ca_id = $idCargaAcademica->idCA;
                $examenAlumno->respuestas = $respuesta;
                $examenAlumno->save();

                unset($this->respuestaAlumno);
                $this->respuestaAlumno=[];
            }

            //$this->iteracion = $this->iteracion + 1;

            if($ultimo){
                
                //$this->iteracion = $this->iteracion - 1;
                $this->showExamen = false;
                $this->mensaje = "Finalizaste tu examen...";
                $this->bloqueo = true; 
            }
        }else {
            $this->mensaje = "Ya exediste la hora limite...";
            $this->showExamen = false;
        }
    }

}
