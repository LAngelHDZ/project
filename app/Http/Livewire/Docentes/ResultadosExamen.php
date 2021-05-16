<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\RespuestasAlumno;

class ResultadosExamen extends Component
{
    public $examen, $alumno;
    public $resultados;
    public $totalPuntos=0, $puntosObtenidos=0;
    
    public function render()
    {
        $this->getResultadosExamen();
        $this->getTotalPuntuacion();
        $this->puntuacionObtenida();
        return view('livewire.docentes.resultados-examen');
    }

    public function getResultadosExamen(){
        $this->resultados = DB::table('examen_alumno')
        ->join('preguntas_examen', 'examen_alumno.pregunta_id', '=', 'preguntas_examen.idPregunta')
        ->select('examen_alumno.*', 'preguntas_examen.pregunta','preguntas_examen.tipo', 'preguntas_examen.puntos')
        ->where('examen_alumno.alumno_ca_id', $this->alumno)
        ->where('examen_alumno.examen_id', $this->examen)
        ->get();
    } 

    public function goArray($respuetas){
        $res = explode(',', $respuetas);
        return $res;        
    }

    public function getRespuestas($idRespuesta){
        $respuesta = DB::table('respuestas_preguntas')
        ->select('respuestas_preguntas.respuesta')
        ->where('respuestas_preguntas.idRespuesta', $idRespuesta)
        ->get();

        $res ='';

        foreach ($respuesta as $key => $value) {
            # code...
            $res = $value->respuesta;
        }

        return $res;
    }

    public function getRespuestasDocente($idPregunta){
        $respuestas = DB::table('respuestas_preguntas')
        ->select('respuesta')
        ->where('pregunta_id', $idPregunta)
        ->where('rcorrecta', 1)
        ->get();

        return $respuestas;
    }

    public function correctAnswer($idResAlumno){
        $resAlumno = RespuestasAlumno::updateOrCreate(
            ['examen_alumno_id' => $idResAlumno ],
            ['rcorrecta' => 1]
        );

        $this->dispatchBrowserEvent('showMensaje');
    }

    public function incorrectAnswer($idResAlumno){
        $resAlumno = RespuestasAlumno::updateOrCreate(
            ['examen_alumno_id' => $idResAlumno ],
            ['rcorrecta' => 0]
        );
        
        $this->dispatchBrowserEvent('showMensaje');
    }

    public function getTotalPuntuacion(){
        $puntos = DB::table('preguntas_examen')
        ->select(DB::raw('SUM(puntos) as total'))
        ->where('examen_id', $this->examen )
        ->first(); 

        $this->totalPuntos = $puntos->total;
    }

    public function puntuacionObtenida(){
        $puntos = DB::table('respuestas_alumno')
        ->join('examen_alumno', 'respuestas_alumno.examen_alumno_id', '=', 'examen_alumno.idExamenAlumno')
        ->join('preguntas_examen', 'examen_alumno.pregunta_id', '=', 'preguntas_examen.idPregunta')
        ->select(DB::raw('SUM(preguntas_examen.puntos) as total'))
        ->where('respuestas_alumno.rcorrecta', 1)
        ->where('examen_alumno.examen_id', $this->examen )
        ->first();

        $this->puntosObtenidos = $puntos->total; 
    }

}
