<?php

namespace App\Http\Controllers;

use App\Models\Abono;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UsuarioController extends Controller
{
    public function formRegistrarUsuario(){
        return view("Usuarios.usuarioFormulario");
    }

    public function storeUsuario(Request $request){
    
        $usuarios = Usuario::all();
        $existe = 0;

        foreach($usuarios as $item){
            if($item->cedula == $request->cedula){
                $existe = 1;
            }
        }

        if($existe == 1){
            session()->flash("usuarioExiste","El nombre del cliente que desea registrar ya existe");
            return redirect()->route("formRegistrarUsuario")->withInput();
        }else{

        $interesesGanados = $request->prestamo * ($request->intereses/100);
        $saldo = $request->prestamo + $interesesGanados;

        $usuario = new Usuario();
        $usuario->cedula = $request->cedula;
        $usuario->nombre = $request->nombre;
        $usuario->telefono = $request->telefono;
        $usuario->direccion = $request->direccion;
        $usuario->prestamo = $request->prestamo;
        $usuario->intereses = $request->intereses;
        $usuario->metodoPago = $request->metodoPago;
        $usuario->saldo = $saldo;
        $usuario->saldoRebajado = $saldo;
        $usuario->interesesGanados = $interesesGanados;

        $usuario->save();
        session()->flash("guardadoCorrectamente","Cliente guardado correctamente");

        return redirect()->route("paginaPrincipal");

        }
    }

    public function eliminarUsuario(Request $request){

        $usuario = Usuario::where('id',$request->id)->first(); // busco la cedula del usuario para eliminar los abonos
        $deleteAbonos = Abono::where('cedula',$usuario->cedula)->delete();

        $delete=Usuario::where('id',$request->id)->delete();


        session()->flash("eliminadoCorrectamente","Cliente eliminado correctamente");
        return redirect()->route("paginaPrincipal");
    }

    public function actualizarUsuario(Request $request){
        $usuario = Usuario::where('id',$request->id)->first();
        return view("Usuarios.usuarioFormularioActualizar",compact("usuario"));
    }

    public function storeActualizarUsuario(Request $request){

        $usuario = Usuario::where('id',$request->id)->first();

        if($usuario->cedula == $request->cedula){
            $interesesGanados = $request->prestamo * ($request->intereses/100);
            $saldo = $request->prestamo + $interesesGanados;
    
            $usuario=Usuario::where('id',$request->id)->first();
    
            $usuario->cedula = $request->cedula;
            $usuario->nombre = $request->nombre;
            $usuario->telefono = $request->telefono;
            $usuario->direccion = $request->direccion;
            $usuario->prestamo = $request->prestamo;
            $usuario->intereses = $request->intereses;
            $usuario->metodoPago = $request->metodoPago;
            $usuario->saldo = $saldo;
            $usuario->saldoRebajado = $saldo;
            $usuario->interesesGanados = $interesesGanados;
    
            $usuario->save();
    
            session()->flash("actualizadoCorrectamente","Cliente actualizado correctamente");
            return redirect()->route("paginaPrincipal");
        }else{

            $usuarios = Usuario::all();
            $existe = 0;
    
            foreach($usuarios as $item){
               if($item->cedula == $request->cedula){
                    $existe = 1;
               }
            }

            if($existe == 1){
                $id = $request->id;
                session()->flash("usuarioRepite","El cliente que desea actualizar ya existe");
                return redirect()->route("actualizarUsuario",compact("id"))->withInput();
            }else{
                $interesesGanados = $request->prestamo * ($request->intereses/100);
                $saldo = $request->prestamo + $interesesGanados;
        
                $usuario=Usuario::where('id',$request->id)->first();
        
                $usuario->cedula = $request->cedula;
                $usuario->nombre = $request->nombre;
                $usuario->telefono = $request->telefono;
                $usuario->direccion = $request->direccion;
                $usuario->prestamo = $request->prestamo;
                $usuario->intereses = $request->intereses;
                $usuario->metodoPago = $request->metodoPago;
                $usuario->saldo = $saldo;
                $usuario->saldoRebajado = $saldo;
                $usuario->interesesGanados = $interesesGanados;
        
                $usuario->save();
        
                session()->flash("actualizadoCorrectamente","Cliente actualizado correctamente");
                return redirect()->route("paginaPrincipal");
            }
        }

    }

    public function aplicarAbono(Request $request){

        $usuario=Usuario::where('id',$request->id)->first(); //obtengo los datos completos del usuario

        $abonos=Abono::where('cedula',$usuario->cedula)->get(); //obtengo los datos completos del usuario

        $abonoUltimo=Abono::where('cedula',$usuario->cedula)->latest()->first(); //obtengo los datos del ultimo abono

        if($abonoUltimo == null){
            return view("Abonos.indexAbono2",compact("usuario","abonos","abonoUltimo"));
        }else{
            return view("Abonos.indexAbono",compact("usuario","abonos","abonoUltimo"));
        }
    }

    public function storeAbono(Request $request){

        $id = $request->id;

        $usuario=Usuario::where('id',$request->id)->first(); //obtengo los datos completos del usuario

        //return $request;
        $abono = new Abono();

        $abono->cedula = $request->cedula;
        $abono->abono = $request->abono;
        $abono->saldo = $usuario->saldoRebajado - $request->abono;
        $abono->save();

        $usuario->saldoRebajado = $usuario->saldoRebajado - $request->abono;
        $usuario->save();

        $abonos=Abono::where('cedula',$usuario->cedula)->get(); //obtengo los datos completos del usuario

        session()->flash("abonoAplicado","Abono aplicado correctamente");
        return redirect()->route("aplicarAbono",compact("id"));


        //return view("Abonos.indexAbono",compact("usuario","abonos"));
    }
}
