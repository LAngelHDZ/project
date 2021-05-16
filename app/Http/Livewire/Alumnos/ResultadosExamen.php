<?php

namespace App\Http\Livewire\Alumnos;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ResultadosExamen extends Component
{
    public $examen;
    public $alumno_ca;
    public $totalPuntos=0, $puntosObtenidos=0, $resultados;

    public function render()
    {
        $this->getTotalPuntos();
        $this->puntosObtenidos(); 
        $this->datosNecesarios();
        $this->getResultadosExamen();
        return view('livewire.alumnos.resultados-examen');
    }

    public function datosNecesarios(){
        $alumno = DB::table('alumnos')
        ->where('alumnos.user_id', Auth::id())
        ->select('alumnos.idAlumno')
        ->first();

        $curso = DB::table('examencurso')
        ->where('examencurso.idExamen', $this->examen)
        ->select('examencurso.curso_id')
        ->first();
        
        $alumnoCarAca = DB::table('carga_academica')
        ->where('alumno_id', $alumno->idAlumno)
        ->where('curso_id', $curso->curso_id)
        ->select('idCA')
        ->first();
        
        $this->alumno_ca = $alumnoCarAca->idCA; 
    }

    public function getTotalPuntos(){
        $puntos = DB::table('preguntas_examen')
        ->select(DB::raw('SUM(puntos) as total'))
        ->where('examen_id', $this->examen )
        ->first();

        $this->totalPuntos = $puntos->total;
    }

    public function puntosObtenidos(){
        $puntos = DB::table('respuestas_alumno')
        ->join('examen_alumno', 'respuestas_alumno.examen_alumno_id', '=', 'examen_alumno.idExamenAlumno')
        ->join('preguntas_examen', 'examen_alumno.pregunta_id', '=', 'preguntas_examen.idPregunta')
        ->select(DB::raw('SUM(preguntas_examen.puntos) as total'))
        ->where('respuestas_alumno.rcorrecta', 1)
        ->where('examen_alumno.examen_id', $this->examen )
        ->first();

        $this->puntosObtenidos = $puntos->total; 
    }
    public function getResultadosExamen(){
        $this->resultados = DB::table('examen_alumno')
        ->join('preguntas_examen', 'examen_alumno.pregunta_id', '=', 'preguntas_examen.idPregunta')
        ->join('respuestas_alumno', 'examen_alumno.idExamenAlumno', '=', 'respuestas_alumno.examen_alumno_id')
        ->select('examen_alumno.*', 'preguntas_examen.pregunta','preguntas_examen.tipo', 'preguntas_examen.puntos', 'respuestas_alumno.rcorrecta')
        ->where('examen_alumno.alumno_ca_id', $this->alumno_ca)
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

}
