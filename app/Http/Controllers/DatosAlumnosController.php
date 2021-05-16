<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Alumnos_datos;
use App\Models\Alumnos;
use App\Models\User;
use App\Rules\CURP;

class DatosAlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'email' => 'el campo :attribute debe ser un e-mail valido.'
        ];

        $rules = [
            'direccion' => 'required|string',
            'lugar_nacimiento' => 'required',
            'dia' => 'required',
            'mes' => 'required',
            'year' => 'required',
            'genero' => 'required|string',
            'estado_civil' => 'required|string',
            'colonia' => 'required|string',
            'ciudad'=> 'required|string',
            'telefono' => 'required|string',
            'codigo_postal' => 'required|string',
            'curp' => 'required|string',
            'ssn' => 'required|string',
            'tipo_sangre' => 'required|string',
            'alergias' => 'required|string',
            'alergias_medicamento' => 'required|string',
            'complicaciones_medicas' => 'required|string',
            'nombre_madre' => 'required|string',
            'domicilio_madre' => 'required|string',
            'colonia_madre' => 'required|string',
            'telefono_madre' => 'required|string',
            'nombre_padre' => 'required|string',
            'domicilio_padre' => 'required|string',
            'colonia_padre' => 'required|string',
            'telefono_padre' => 'required|string',
            'nombre_contacto' => 'required|string',
            'telefono_contacto' => 'required|string',
            'parentesco_contacto' => 'required|string',
            'nombre_contacto2' => 'required|string',
            'telefono_contacto2' => 'required|string',
            'parentesco_contacto2' => 'required|string'
        ];

        $validator = Validator::make($request->all(),$rules,$messages)->validate();

        $request->validate([
            'curp' => [new CURP],
        ]);

        $cheack = checkdate($request->mes, $request->dia, $request->year);

        if(!$cheack){
            $error = 'La fecha que ingreso no es una fecha valida';
            return back()->withErrors($error);
        }

        
        /*$validation = $request->validate([
            'direccion' => 'required|string',
            'lugar_nacimiento' => 'required',
            'fecha_nacimiento' => 'required',
            'genero' => 'required|string',
            'estado_civil' => 'required|string',
            'colonia' => 'required|string',
            'ciudad'=> 'required|string',
            'telefono' => 'required|string',
            'codigo_postal' => 'required|string',
            'curp' => 'required|string',
            'ssn' => 'required|string',
            'tipo_sangre' => 'required|string',
            'alergias' => 'required|string',
            'alergias_medicamento' => 'required|string',
            'complicaciones_medicas' => 'required|string',
            'nombre_madre' => 'required|string',
            'domicilio_madre' => 'required|string',
            'colonia_madre' => 'required|string',
            'telefono_madre' => 'required|string',
            'nombre_padre' => 'required|string',
            'domicilio_padre' => 'required|string',
            'colonia_padre' => 'required|string',
            'telefono_padre' => 'required|string',
            'nombre_contacto' => 'required|string',
            'telefono_contacto' => 'required|string',
            'parentesco_contacto' => 'required|string',
            'nombre_contacto2' => 'required|string',
            'telefono_contacto2' => 'required|string',
            'parentesco_contacto2' => 'required|string'
        ]);*/


        $idUser = Auth::id();
        $idAlumno = Alumnos::where('user_id', $idUser )->first();

        $datos = new Alumnos_datos;
        $datos->alumno_id = $idAlumno->idAlumno;
        $datos->lugarNac = $request->lugar_nacimiento;
        $datos->fechaNac = $request->year.'/'.$request->mes.'/'.$request->dia;
        $datos->genero = $request->genero;
        $datos->estado_civil = $request->estado_civil;
        $datos->direccion = $request->direccion;
        $datos->colonia = $request->colonia;
        $datos->ciudad = $request->ciudad;
        $datos->telefono = $request->telefono;
        $datos->cp = $request->codigo_postal;
        $datos->curp = $request->curp;
        $datos->num_seguro = $request->ssn;
        $datos->tipo_sangre = $request->tipo_sangre;
        $datos->alergias = $request->alergias;
        $datos->medicamentos_alergicos = $request->alergias_medicamento;
        $datos->complicaciones_medicas = $request->complicaciones_medicas;
        $datos->nom_madre = $request->nombre_madre;
        $datos->direccion_madre = $request->domicilio_madre;
        $datos->colonia_madre = $request->colonia_madre;
        $datos->tel_madre = $request->telefono_madre;
        $datos->nom_padre = $request->nombre_padre;
        $datos->direccion_padre = $request->domicilio_padre;
        $datos->colonia_padre = $request->colonia_padre;
        $datos->tel_padre = $request->telefono_padre;
        $datos->contacto_emergencia = $request->nombre_contacto;
        $datos->tel_contacto = $request->telefono_contacto;
        $datos->parentesco = $request->parentesco_contacto;
        $datos->contacto_emergencia2 = $request->nombre_contacto2;
        $datos->tel_contacto2 = $request->telefono_contacto2;
        $datos->parentesco2 = $request->parentesco_contacto2;
        $datos->save();

        $actualizauser = User::where('id', $idUser )
        ->update(['perfil_completo' => true]);

        return redirect()->intended('dashboard');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
