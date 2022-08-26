<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\User;
use App\Models\Distrito;
use App\Models\OrdenFeedback;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{

    public function __construct(){
        $this->middleware('can:dashboard')->only('dashboard');
    }

    public function login(LoginRequest $request)
    {
        $credenciales = $request->only('email', 'password');
        
        if (!Auth::attempt($credenciales)) {
            return redirect("login")->withErrors(['credenciales' => ['Credenciales incorrectas.']]);
        }

        $usuario = Auth::getProvider()->retrieveByCredentials($credenciales);

        Auth::login($usuario);

        if($usuario->role_id == 1){
            return redirect('/dashboard');
        }elseif($usuario->role_id == 2){
            return redirect('/proveedor');
        }else{
            return redirect('/');
        }

        

    }

    public function register(RegisterRequest $request)
    {
        if($request->role_id == 3){
            $usuario = User::create($request->only(
                [
                    'name', 'email', 'password', 
                    'apellido_paterno', 'role_id'
                ]
            ))->assignRole('cliente');
        }elseif($request->role_id == 2){
            $usuario = User::create($request->only(
                [
                    'name', 'email', 'password','documento', 'role_id'
                ]
            ))->assignRole('proveedor');
        }

        

        auth()->login($usuario);
        return redirect("/")->with('message', 'Registrado exitosamente');
    }


    public function update(UpdateRequest $request)
    {

            $datosUsuario = request()->except(['_token','_method']);

            if($request->hasFile('foto')){
             $file = $request->file('foto');
             $name = $file->getClientOriginalName();
            
             $archivo = $request->file('foto');
             $archivo->move(public_path().'/images/usuarios/',$name);

             $datosUsuario['foto'] = $name;
            }

            

            User::where('id','=',$request->id)->update($datosUsuario);

            return redirect("/")->with('message', 'Editado exitosamente');

            
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect("/");
    }

    public function dashboard()
    {
        $feedbacks = OrdenFeedback::query()->with('orden', 'tipo_feedback');
        $feedbacks = Auth::user()->hasRole('admin') 
            ? $feedbacks 
            : $feedbacks->whereHas('orden.detalle.producto',function($query) {
                $query->where('producto.id_proveedor', Auth::user()->id);
            });

        $feedbacks = $feedbacks->orderBy('orden_feedback.id_orden_feedback')->paginate(20);
        
        return view('feedback.index', compact('feedbacks'));
    }

}
