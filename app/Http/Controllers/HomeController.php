<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return view("Index.index");
    }
    public function verificarLogin(Request $request){

        $request =  request()->only("email","password");
        if(Auth::attempt($request)){
            request()->session()->regenerate();
            //return "logeado correctamente";
            return redirect()->route("paginaPrincipal");
        }else{
            session()->flash("errorLogueo","Correo o contraseña incorrecto");
            return redirect()->route("index");
        }
    }

    public function paginaPrincipal(Request $request){

        //return $request;

            $sumaAcobrar = Usuario::sum("saldoRebajado");

            $txtBuscar = $request->input('txtBuscar');
            $usuarios = Usuario::where('nombre', 'LIKE', '%'.$txtBuscar.'%')->orderBy('nombre', 'asc')->get();

            //$usuarios = Usuario::all();
            return view("PaginaPrincipal.paginaPrincipal",compact("usuarios","txtBuscar","sumaAcobrar"));

        
    
    }

    public function deslogueo(Request $request){
        Auth::logout();

        $request->session()->invalidate(); //invalida la sesion del usuario 
        $request->session()->regenerateToken(); // regenera el token

        return redirect()->route("index");
    }
}
