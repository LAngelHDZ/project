<?php

namespace App\Http\Livewire\Docentes;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class EstadisticasGrupo extends Component
{
    public $idCurso;
    public $unidades, $aprobados, $reprobados, $cursoAprobados=0, $cursoReprobados=0;

    public function render()
    {
        $this->getUnidades();
        $this->getAprobados();
        $this->getReprobados();
        return view('livewire.docentes.estadisticas-grupo');
    }

    public function getUnidades(){
        
        $materia = DB::table('curso')
        ->select('materia_id')
        ->where('idCurso', $this->idCurso)
        ->first();

        $unidades = DB::table('temas')
        ->where('tipo', 1)
        ->where('materia_id', $materia->materia_id)
        ->select('nombreTema')
        ->get(); 

        $this->unidades = array();

        foreach ($unidades as $key => $value) {
            # code...
            $this->unidades[] = $value->nombreTema;
        }
    }

    public function getAprobados(){
        $materia = DB::table('curso')
        ->select('materia_id')
        ->where('idCurso', $this->idCurso)
        ->first();

        $aprobados = DB::table('temas')
        ->leftJoin('calificacionparcial', 'temas.idTema', '=', 'calificacionparcial.unidad_id')
        ->select('temas.nombreTema', DB::raw('count( calificacionparcial.calificacion ) as alumnos') )
        ->where('temas.tipo', 1)
        ->where('temas.materia_id', $materia->materia_id)
        ->where('calificacionparcial.calificacion', '>', 70)
        ->groupBy('temas.idTema')
        ->orderBy('temas.indice')
        ->get();

        $this->aprobados = array();

        foreach ($aprobados as $key => $value) {
            # code...
            $this->aprobados[] = $value->alumnos;
        }
    }

    public function getReprobados(){
        $materia = DB::table('curso')
        ->select('materia_id')
        ->where('idCurso', $this->idCurso)
        ->first();

        $reprobados = DB::table('temas')
        ->leftJoin('calificacionparcial', 'temas.idTema', '=', 'calificacionparcial.unidad_id')
        ->select('temas.nombreTema', DB::raw('count( calificacionparcial.calificacion ) as alumnos') )
        ->where('temas.tipo', 1)
        ->where('temas.materia_id', $materia->materia_id)
        ->where('calificacionparcial.calificacion', '<', 70)
        ->groupBy('temas.idTema')
        ->orderBy('temas.indice')
        ->get();

        $this->reprobados = array();

        foreach ($reprobados as $key => $value) {
            # code...
            $this->reprobados[] = $value->alumnos;
        }
    }

    public function getEstadisticasGrupo(){
        $this->cursoAprobados = DB::table('carga_academica')
        ->join('calificacionfinal', 'carga_academica.idCA', '=', 'calificacionfinal.alumno_ins_id')
        ->where('carga_academica.curso_id', $this->idCurso)
        ->where('calificacionfinal.calificacion', '>', 70)
        ->count();
        
        $this->cursoReprobados = DB::table('carga_academica')
        ->join('calificacionfinal', 'carga_academica.idCA', '=', 'calificacionfinal.alumno_ins_id')
        ->where('carga_academica.curso_id', $this->idCurso)
        ->where('calificacionfinal.calificacion', '<', 70)
        ->count();
    }
}
