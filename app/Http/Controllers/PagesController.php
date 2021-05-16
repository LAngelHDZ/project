<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Alumnos;
use App\Models\Docente;
use App\Rules\RFCRule;
use App\Rules\EmailInstitucion;


class PagesController extends Controller
{
    //

    public function counter(){
        return view('alumnos.prueba');
    }

    public function app_login(Request $request){

        return $request;
    }

    //registro de alumnos 
    public function app_register(Request $request){

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'email' => 'El campo :attribute debe ser un e-mail valido.',
            'min' => 'El campo :attribute debe tener minimo de 5 caracteres',
            'max' => 'El campo :attribute debe tener maximo de 15 caracteres'
        ];

        $rules = [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'matricula' => 'required|integer',
            'email' => 'required|email',
            'password' => 'required|string|min:5|max:15',
            'password_confirmation' => 'required|string',
            'carrera' => 'required|string',
            'semestre' => 'required|string'
        ];

        $validator = Validator::make($request->all(),$rules,$messages)->validate();

        $request->validate([
            'email' => [new EmailInstitucion],
        ]);

        if($request->password != $request->password_confirmation){
            $mesanje = 'Passwords dosent match';
            return back()->withErrors($mesanje);
        }else{

            $ncontrol = $this->verificarNControl($request->matricula);
            $email = $this->verificarEmail($request->email);
            
            if($email == 1 && $ncontrol == 1){
                $erroremail = "El Email ya a sido registrado";
                $errorNControl = "N. Control ya a sido registrado";
                return back()->withErrors(compact('erroremail','errorNControl'));
            }
            else if($email == 1 && $ncontrol == 0){
                $erroremail = "El Email ya a sido registrado";
                return back()->withErrors(compact('erroremail'));
            }
            else if($email == 0 && $ncontrol == 1){
                $errorNControl = "N. Control ya a sido registrado";
                return back()->withErrors(compact('errorNControl'));
            } 

            $usuario = new User;
            $usuario->name = $request->name;
            $usuario->lastname = $request->lastname;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->tipo_user = 1;
            $usuario->perfil_completo = false;
            $usuario->save();

            $iduser = User::where('email', $request->email)->first(); 
            $iduser->assignRole('Alumno');

            $alumno = new Alumnos;
            $alumno->nControl = $request->matricula;
            $alumno->carrera = $request->carrera;
            $alumno->semestre = $request->semestre;
            $alumno->user_id = $iduser->id;
            $alumno->save();
            
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('dashboard');
            }else{
                return back();
            }
        }
    }

    public function app_register_docente(Request $request){

        $rules = [
            'name' => 'required|string',
            'lastname' => 'required|string',
            'matricula' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string|min:5|max:15',
            'password_confirmation' => 'required|string',
            'rfc' => 'required|string'
        ];

        $messages = [
            'required' => 'El campo :attribute es requerido.',
            'email' => 'el campo :attribute debe ser un e-mail valido.',
            'min' => 'El campo :attribute debe tener minimo de 5 caracteres',
            'max' => 'El campo :attribute debe tener maximo de 15 caracteres'
        ];

        $validator = Validator::make($request->all(),$rules)->validate();

        $request->validate([
            'rfc' => [new RFCRule],
            'email' => [new EmailInstitucion]
        ]);

        if($request->password != $request->password_confirmation){
            $mesanje = 'Las contraseñas no coinciden';
            return back()->with(compact('mensaje'));
        }else{

            $matricula = $this->verificarMatricula($request->matricula);
            $email = $this->verificarEmail($request->email);
            
            if($email == 1 && $matricula == 1){
                $erroremail = "El email ya a sido resgistado";
                $errorNControl = "La matricula ya a sido registrada";
                return back()->withErrors(compact('erroremail','errorNControl'));
            }
            else if($email == 1 && $matricula == 0){
                $erroremail = "El Email ya a sido registrado";
                return back()->withErrors(compact('erroremail'));
            }
            else if($email == 0 && $matricula == 1){
                $errorNControl = "La Matricula ya a sido registrada";
                return back()->withErrors(compact('errorNControl'));
            }

            $usuario = new User;
            $usuario->name = $request->name;
            $usuario->lastname = $request->lastname;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->tipo_user = 2;
            $usuario->perfil_completo = false;
            $usuario->save();

            $iduser = User::where('email', $request->email)->first();
            $iduser->assignRole('Docente');

            $docente = new Docente;
            $docente->matricula = $request->matricula;
            $docente->RFC = $request->rfc;
            $docente->user_id = $iduser->id;
            $docente->save();
            
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended('dashboard');
            }else{
                return back();
            }
        }
    }

    public function invitado(){
        return view('invitado');    
    }

    protected function verificarNControl($ncontrol){

        $alumno = DB::table('alumnos')->where('nControl', $ncontrol)->get();
        return $alumno->count(); 
    }
    
    protected function verificarMatricula($matricula){
        $alumno = DB::table('docente')->where('matricula', $matricula)->get();
        return $alumno->count(); 
    }

    protected function verificarEmail($email){
        $usuario = DB::table('users')->where('email', $email)->get();
        return $usuario->count();
    }

}
