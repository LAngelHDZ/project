<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Docente;
use App\Models\Docente_datos;
use App\Models\User;
use App\Rules\CURP;

class DatosDocentesController extends Controller
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
        $rules = [
            'lugar_nacimiento' => 'required|string',
            'year' => 'required',
            'dia' => 'required',
            'mes' => 'required', 
            'estado_civil' => 'required|string',
            'genero' => 'required|string', 
            'direccion' => 'required|string',
            'colonia' => 'required|string',
            'ciudad' => 'required|string',
            'telefono' => 'required|string',
            'codigo_postal' => 'required|string',
            'curp' => 'required|string',
            'ssn' => 'required|string',
            'tipo_sangre' => 'required|string',
            'alergias' => 'required|string',
            'alergias_medicamento' => 'required|string',
            'complicaciones_medicas' => 'required|string',
            'contacto_Emergencia' => 'required|string',
            'telefono_contacto' => 'required|string',
            'parentesco' => 'required|string',
            'contacto_Emergencia2' => 'required|string',
            'telefono_contacto2' => 'required|string',
            'parentesco2' => 'required|string'
        ];

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'email' => 'el campo :attribute debe ser un e-mail valido.'
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
            'lugar_nacimiento' => 'required|string',
            'fecha_nacimiento' => 'required|string',
            'estado_civil' => 'required|string',
            'genero' => 'required|string', 
            'direccion' => 'required|string',
            'colonia' => 'required|string',
            'ciudad' => 'required|string',
            'telefono' => 'required|string',
            'codigo_postal' => 'required|string',
            'curp' => 'required|string',
            'ssn' => 'required|string',
            'tipo_sangre' => 'required|string',
            'alergias' => 'required|string',
            'alergias_medicamento' => 'required|string',
            'complicaciones_medicas' => 'required|string',
            'contacto_Emergencia' => 'required|string',
            'telefono_contacto' => 'required|string',
            'parentesco' => 'required|string',
            'contacto_Emergencia2' => 'required|string',
            'telefono_contacto2' => 'required|string',
            'parentesco2' => 'required|string',
        ]);*/

        $idUser = Auth::id();
        $idDocente = Docente::where('user_id', $idUser )->first();

        $datos = new Docente_datos;
        $datos->docente_id = $idDocente->idDocente;
        $datos->lugarNac = $request->lugar_nacimiento;
        $datos->fechaNac = $request->year.'/'.$request->mes.'/'.$request->dia;
        $datos->estado_civil = $request->estado_civil;
        $datos->genero = $request->genero;
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
        $datos->contacto_emerg = $request->contacto_Emergencia;
        $datos->tel_contacto = $request->telefono_contacto;
        $datos->parentesco = $request->parentesco;
        $datos->contacto_emerg2 = $request->contacto_Emergencia2;
        $datos->tel_contacto2 = $request->telefono_contacto2;
        $datos->parentesco2 = $request->parentesco2;
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
