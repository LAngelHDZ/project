<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PrivateController;
use App\Http\Controllers\DatosAlumnosController;
use App\Http\Controllers\DatosDocentesController;
use App\Http\Controllers\CursosController;
use App\Http\Controllers\CursosAlumnosController;
use App\Http\Controllers\ActividadTemaDocente;

Route::get('/', function () {
    return view('welcome');
});

Route::post('app_login', [PagesController::class, 'app_login'])->name('app_login');

Route::post('app_register', [PagesController::class,'app_register'])->name('app_register');

Route::post('app_register_docente', [PagesController::class, 'app_register_docente'])->name('app_register_docente');

//Route::get('invitados', [PagesController::class, 'invitado'])->name('invitado');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


// TODO: rutas docentes
Route::get('register_docente', function(){
    return view('auth.register_docente');
})->name('register_docente');

Route::get('datos_socioeconomicos_docentes', [PrivateController::class, 'perfil_completo_docente'])->name('dsoceco_docente')->middleware('auth','role:Docente');

Route::resource('datos_docentes', DatosDocentesController::class)->only([
    'store'
])->middleware('auth','role:Docente');

Route::get('docente/cursos_docente',[ CursosController::class,'index'])->name('cursos_docentes.index')->middleware('auth','role:Docente');
Route::get('docente/cursos_docente/{id}',[ CursosController::class,'show'])->name('cursos_docentes.show')->middleware('auth','role:Docente');
Route::get('horarios_docentes',[PrivateController::class, 'horario_docente'])->name('horario_docente')->middleware('auth','role:Docente');
Route::get('docente/actividad/create/{curso}/{tema}',[PrivateController::class, 'formActividadesTemaCurso'])->name('docenteaddActividad')->middleware('auth','role:Docente');
Route::get('docente/viewActividad/{id}', [ActividadTemaDocente::class, 'show'])->name('viewActividadDocente')->middleware('auth');
Route::get('docente/curso/{curso}/descripcion_alumno/{alumno}', [PrivateController:: class, 'descripcionAlumno'])->name('descripcionAlumno')->middleware('auth', 'role:Docente');
Route::get('docente/cal_actividades', [PrivateController::class, 'calActividades'])->name('calActividades')->middleware('auth','role:Docente');
Route::get('docente/curso/{curso}/calActividades', [PrivateController::class, 'calificarActividades'])->name('calificarActividades')->middleware('auth','role:Docente');
Route::get('docente/curso/{curso}/calUnidades', [PrivateController::class, 'calificarUnidad'])->name('calificarUnidades')->middleware('auth','role:Docente');
Route::get('docente/curso/{curso}/calCurso', [PrivateController::class, 'calificarCurso'])->name('calificarCurso')->middleware('auth','role:Docente');
Route::get('docente/curso/{curso}/createExamen', [PrivateController::class, 'createExamen'])->name('createExamen')->middleware('auth', 'role:Docente');
Route::get('docente/curso/examen/{examen}/preguntas', [PrivateController::class, 'createPreguntasExamen'])->name('createPreguntasExamen')->middleware('auth', 'role:Docente');
Route::get('docente/curso/examen/{idexamen}/alumno/{alumno}', [PrivateController::class, 'resultadosExamenAlumno'])->name('resultadosAlumnos')->middleware('auth', 'role:Docente');
/* * */

// TODO: rutas alumnos
Route::get('datos_socioeconomicos_alumnos', [PrivateController::class, 'perfil_completo_alumno'])->name('dsoceco_alumno')
->middleware('auth','role:Alumno');

Route::resource('datos_alumnos', DatosAlumnosController::class)->only([
    'store'
])->middleware('auth','role:Alumno');

Route::get('descripcion_cursos/{id}', [PrivateController::class, 'descripcionCursoAlumno'])->name('descripcionCurso')->middleware('auth','role:Alumno');
Route::get('alumnos/cursos_alumno',[CursosAlumnosController::class, 'index'])->name('cursos_alumnos.index')->middleware('auth','role:Alumno');
Route::get('alumnos/cursos_alumno/{id}',[CursosAlumnosController::class, 'show'])->name('cursos_alumnos.show')->middleware('auth','role:Alumno');
Route::get('horarios_alumnos',[PrivateController::class, 'horario_alumno'])->name('horarios_alumnos')->middleware('auth','role:Alumno');
Route::post('sendSolicitud', [PrivateController::class, 'sendSolicitud'])->name('sendSolicitud')->middleware('auth','role:Alumno');
Route::get('alumnos/all_cursos', [PrivateController::class, 'allCursos'])->name('allCursos')->middleware('auth','role:Alumno');
Route::get('alumnos/view_actividad/{id}', [PrivateController::class, 'viewActividadAlumno'])->name('viewActividadAlumno')->middleware('auth','role:Alumno');
Route::get('alumnos/horario', [PrivateController::class, 'getHorario'])->name('horario')->middleware('auth', 'role:Alumno');
Route::get('alumnos/curso/examen/{idExamen}', [PrivateController::class, 'vistaExamenAlumno'])->name('viewExamenAlumno')->middleware('auth','role:Alumno');
Route::get('alumnos/curso/startExamen/{idExamen}', [PrivateController::class, 'startExamen'])->name('startExamen')->middleware('auth', 'role:Alumno');
Route::get('alumnos/curso/resultados_examen/{idExamen}', [PrivateController::class , 'resultadosExamenStudent'])->name('resultadosStudent')->middleware('auth', 'role:Alumno');
/* * */
