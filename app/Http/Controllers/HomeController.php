<?php

namespace App\Http\Controllers;

use App\Models\Ahorro;
use App\Models\Usuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
            $clientes = DB::table('usuarios')->count();

            $txtBuscar = $request->input('txtBuscar');
            $usuarios = Usuario::where('nombre', 'LIKE', '%'.$txtBuscar.'%')->orderBy('nombre', 'asc')->get();

            //$usuarios = Usuario::all();
            return view("PaginaPrincipal.paginaPrincipal",compact("usuarios","txtBuscar","sumaAcobrar","clientes"));

        
    
    }

    public function deslogueo(Request $request){
        Auth::logout();

        $request->session()->invalidate(); //invalida la sesion del usuario 
        $request->session()->regenerateToken(); // regenera el token

        return redirect()->route("index");
    }






















    public function steven(){

        $ahorros = Ahorro::all();
        $sumaTotal = Ahorro::sum("monto");
        return view("steven.formSteven",compact("ahorros","sumaTotal"));
    }




    public function storeAplicarAbonoOpeCuadros(Request $request){
        if ($request->ajax()) {
            $tipoAhorro = $request->input('tipoAhorro');
            $opeCuadros = $request->input('opeCuadros');


            if($opeCuadros == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (2500 * $opeCuadros);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }


    public function storeAplicarAhorroEmergencia(Request $request){
        if ($request->ajax()) {
            $tipoAhorro = $request->input('tipoAhorro');
            $ahorroEmergencia = $request->input('ahorroEmergencia');


            if($ahorroEmergencia == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (2500 * $ahorroEmergencia);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }

    public function storeAplicarAhorroRopa(Request $request){
        if ($request->ajax()) {

            $tipoAhorro = $request->input('tipoAhorro');
            $ahorroRopa = $request->input('ahorroRopa');


            if($ahorroRopa == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (5000 * $ahorroRopa);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }




    public function storeAplicarAhorroSiempre(Request $request){
        if ($request->ajax()) {

            $tipoAhorro = $request->input('tipoAhorro');
            $ahorroSiempre = $request->input('ahorroSiempre');


            if($ahorroSiempre == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (5000 * $ahorroSiempre);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }


    public function storeAplicarAhorroAutoNuevo(Request $request){
        if ($request->ajax()) {

            $tipoAhorro = $request->input('tipoAhorro');
            $ahorroAutoNuevo = $request->input('ahorroAutoNuevo');


            if($ahorroAutoNuevo == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (5000 * $ahorroAutoNuevo);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }


    public function storeAplicarAhorroCompraLote(Request $request){
        if ($request->ajax()) {

            $tipoAhorro = $request->input('tipoAhorro');
            $ahorroCompraLote = $request->input('ahorroCompraLote');


            if($ahorroCompraLote == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (2500 * $ahorroCompraLote);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }



    public function storeAplicarAhorroBici(Request $request){
        if ($request->ajax()) {

            $tipoAhorro = $request->input('tipoAhorro');
            $ahorroBici = $request->input('ahorroBici');


            if($ahorroBici == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (5000 * $ahorroBici);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }


    public function storeAplicarMantAuto(Request $request){
        if ($request->ajax()) {

            $tipoAhorro = $request->input('tipoAhorro');
            $ahorroMantAuto = $request->input('ahorroMantAuto');


            if($ahorroMantAuto == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (10000 * $ahorroMantAuto);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }


    public function storeAplicarMarchamo(Request $request){
        if ($request->ajax()) {

            $tipoAhorro = $request->input('tipoAhorro');
            $ahorroMarchamo = $request->input('ahorroMarchamo');


            if($ahorroMarchamo == null){
                return redirect()->route("steven");
            }else{
                $abono = Ahorro::where([["tipoAhorro","=",$tipoAhorro]])->first();
                $abono->monto = $abono->monto + (5000 * $ahorroMarchamo);
                $abono->save();

                return response()->json($abono->monto);
            }

        }
    }

}
