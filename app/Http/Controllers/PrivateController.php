<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cursos;
use App\Models\CargaAcademica;
use App\Models\Alumnos; 
use PDF;

class PrivateController extends Controller
{
    //
    //alumnos
    public function perfil_completo_alumno(){
        return view('alumnos.datos_socioecon');
    }

    public function horario_alumno(){
        return view('alumnos.miHorario');
    }
    
    //vista de descripcion del curso para el alumno
    public function allCursos(){
        return view('alumnos.allCursos');
    }

    public function descripcionCursoAlumno($id){
        $curso = DB::table('curso')
        ->join('docente', 'curso.docente_id', '=' , 'docente.idDocente')
        ->join('materias', 'curso.materia_id', '=', 'materias.idMateria')
        ->join('users', 'docente.user_id', '=', 'users.id')
        ->select('curso.*', 'materias.nombreMateria', 'users.name', 'users.lastname')
        ->where('curso.idCurso',$id)
        ->get();

        $alumnos = Alumnos::where('user_id', Auth::id())->first();

        $solicitud = DB::table('carga_academica')
        ->where('curso_id', $id)
        ->where('alumno_id', $alumnos->idAlumno)
        ->count();

        $cursoId = $id;

        return view('alumnos.descripcionCurso')->with(compact('curso','solicitud','cursoId'));
    }

    public function sendSolicitud(Request $request){
        $solicitud = new CargaAcademica;
        $solicitud->alumno_id = $request->alumno;
        $solicitud->curso_id = $request->curso;
        $solicitud->status = 0;
        $solicitud->save();

        $alerta = array(
            'message' => 'Se envio tu solicitud de inscripcion al grupo',
            'type' => 'success'
        );

        return redirect()->route('dashboard')->with($alerta);
    }

    public function viewActividadAlumno($id){

        return view('alumnos.viewActividad')->with(compact('id'));
    }

    public function getHorario(){

        $idAlumno = Alumnos::where('user_id', Auth::user()->id )->first();

        $nControl = $idAlumno->nControl;
        $datos = DB::table('users')->select('users.name', 'users.lastname')->where('id', $idAlumno->user_id)->first();
        $nameAlumno = $datos->name.' '.$datos->lastname;
        $carrera = $idAlumno->carrera;
        $semestre = $idAlumno->semestre;

        $year = date('Y');
        $mes = date('m');

        if($mes < 6){
            $periodo = 'Enero-Junio';
        }else if($mes > 6){
            $periodo = 'Agosto-Diciembre';
        }else{
            $periodo = 'Verano';
        }

        $cursos = DB::table('carga_academica')
        ->join('curso', 'carga_academica.curso_id', '=', 'curso.idCurso')
        ->join('materias', 'curso.materia_id', '=', 'materias.idMateria')
        ->join('periodo','curso.periodo_id','=','periodo.idPeriodo')
        ->join('docente', 'curso.docente_id', '=', 'docente.idDocente')
        ->join('users', 'docente.user_id', '=', 'users.id')
        ->where('periodo.periodo', $periodo)
        ->where('periodo.year', $year)
        ->where('carga_academica.alumno_id', $idAlumno->idAlumno)
        ->where('carga_academica.status', 1)
        //->select('curso.nombreCurso','curso.descripcion','periodo.periodo','periodo.year')
        ->select('curso.nombreCurso','curso.horario','curso.aula', 'materias.academia','users.name','users.lastname')       
        ->get();


        $pdf = PDF::loadView('alumnos.formatoHorario', compact('cursos','periodo','year','nControl','nameAlumno','carrera','semestre'));
        return $pdf->stream();
    }

    public function vistaExamenAlumno($idExamen){
        
        $examen = DB::table('examencurso')->select('examencurso.*')->where('idExamen', $idExamen)->first();

        return view('alumnos.viewExamen', ['examen' => $examen]);
    }

    public function startExamen($idExamen){
        return view('alumnos.startExamen', ['idExamen' => $idExamen]);
    }

    public function resultadosExamenStudent($idExamen){
        return view('alumnos.resultadosExamen', ['examen' => $idExamen]);
    }

    /* fin metodos de alumnos */

    // TODO: docentes
    public function perfil_completo_docente(){
        return view('docente.datos_socioecon');
    }

    public function horario_docente(){
        return view('docente.miHorario');
    }

    public function formActividadesTemaCurso($curso, $tema){
        return view('docente.addActividadTema', ['curso' => $curso, 'tema' => $tema ]);
    }

    public function descripcionAlumno($curso, $alumno){
        return view('docente.descripcionAlumno', ['curso' => $curso,'idalumno' => $alumno ]);
    } 

    public function calActividades(){
        
        return view('docente.calActividades');
    }

    public function calificarActividades($curso){
        return view('docente.calificarActividades', ['curso' => $curso ]);
    }

    public function calificarUnidad($curso){
        return view('docente.calificarUnidades', ['curso' => $curso]);   
    }

    public function calificarCurso($curso){
        return view('docente.calificarCurso', ['curso' => $curso]);
    }

    public function createExamen($curso) {
        return view('docente.createExamen', ['curso' => $curso ]);
    }

    public function createPreguntasExamen($examen) {
        return view('docente.createPreguntasExamen', ['examen' => $examen ]);
    }

    public function resultadosExamenAlumno($examen, $alumno){
        return view('docente.resultadosExamenAlumno', ['examen' => $examen, 'alumno'=>$alumno]);
    }
    /** fin metodos docentes **/

    
}
