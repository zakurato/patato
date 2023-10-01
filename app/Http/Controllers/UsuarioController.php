<?php

namespace App\Http\Controllers;

use App\Models\Abono;
use App\Models\Estado;
use App\Models\Usuario;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UsuarioController extends Controller
{
    public function formRegistrarUsuario(){
        return view("Usuarios.usuarioFormulario");
    }

    public function formRegistrarUsuario2(Request $request){

        $tipoPago = $request->valor;
        return view("Usuarios.usuarioFormulario2",compact("tipoPago"));
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

        //$interesesGanados = $request->prestamo * ($request->intereses/100);
        $saldo = $request->prestamo + $request->intereses;

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
        $usuario->interesesGanados = $request->intereses;
        $usuario->save();

        $estado = new Estado();
        $estado->idFK = $usuario->id;
        $estado->estado = 1;
        $estado->save();

        session()->flash("guardadoCorrectamente","Cliente guardado correctamente");

        return redirect()->route("paginaPrincipal");

        }
    }

    public function storeUsuario2(Request $request){
    
        $usuarios = Usuario::all();
        $existe = 0;

        foreach($usuarios as $item){
            if($item->cedula == $request->cedula){
                $existe = 1;
            }
        }

        if($existe == 1){
            session()->flash("usuarioExiste","El nombre del cliente que desea registrar ya existe");
            return redirect()->route("formRegistrarUsuario2")->withInput();
        }else{

        //$interesesGanados = $request->prestamo * ($request->intereses/100);
        $saldo = $request->prestamo + $request->intereses;

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
        $usuario->interesesGanados = $request->intereses;
        $usuario->save();

        $estado = new Estado();
        $estado->idFK = $usuario->id;
        $estado->estado = 1;
        $estado->save();

        session()->flash("guardadoCorrectamente","Cliente guardado correctamente");

        $valor = $request->metodoPago;

        return redirect()->route("tablaClientes",compact("valor"));

        }
    }


    public function eliminarUsuario(Request $request){

        $usuario = Usuario::where('id',$request->id)->first(); // busco la cedula del usuario para eliminar los abonos
        $deleteAbonos = Abono::where('cedula',$usuario->cedula)->delete();

        $delete=Usuario::where('id',$request->id)->delete();

        $deleteEstado = Estado::where("idFK", $request->id)->delete();

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
            //$saldo = $request->prestamo + $interesesGanados;
    
            $usuario=Usuario::where('id',$request->id)->first();
    
            $usuario->cedula = $request->cedula;
            $usuario->nombre = $request->nombre;
            $usuario->telefono = $request->telefono;
            $usuario->direccion = $request->direccion;
            $usuario->prestamo = $request->prestamo;
            $usuario->intereses = $request->intereses;
            $usuario->metodoPago = $request->metodoPago;
            //$usuario->saldo = $saldo;
            //$usuario->saldoRebajado = $saldo;
            $usuario->interesesGanados = $interesesGanados;
    
            $usuario->save();

            $valor = $request->metodoPago;

            session()->flash("actualizadoCorrectamente","Cliente actualizado correctamente");
            return redirect()->route("tablaClientes",compact("valor"));
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
                //$saldo = $request->prestamo + $interesesGanados;
        
                $usuario=Usuario::where('id',$request->id)->first();
        
                $usuario->cedula = $request->cedula;
                $usuario->nombre = $request->nombre;
                $usuario->telefono = $request->telefono;
                $usuario->direccion = $request->direccion;
                $usuario->prestamo = $request->prestamo;
                $usuario->intereses = $request->intereses;
                $usuario->metodoPago = $request->metodoPago;
                //$usuario->saldo = $saldo;
                //$usuario->saldoRebajado = $saldo;
                $usuario->interesesGanados = $interesesGanados;
        
                $usuario->save();
                $valor = $request->metodoPago;

                session()->flash("actualizadoCorrectamente","Cliente actualizado correctamente");
                return redirect()->route("tablaClientes",compact("valor"));
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

        if($request->abono > $request->saldoRebajado){
            $id = $request->id;
            session()->flash("abonoExcedido","El abono que desea aplicar es mayor al saldo actual");
            return redirect()->route("aplicarAbono",compact("id")); 
        }else{

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


        $cambioEstadoSiPaga = Estado::where([["idFK","=",$usuario->id]])->first();
        $cambioEstadoSiPaga->estado = 1;
        $cambioEstadoSiPaga->save();

        session()->flash("abonoAplicado","Abono aplicado correctamente");
        return redirect()->route("aplicarAbono",compact("id"));


        //return view("Abonos.indexAbono",compact("usuario","abonos"));

        }
    }

    public function prestamoDeudaForm(Request $request){
        $usuario = Usuario::where('id',$request->id)->first();
        return view("Usuarios.usuarioFormularioPrestamoDeuda",compact("usuario"));
    }

    public function storeActualizarUsuarioPrestamoDeuda(Request $request){

        $usuario = Usuario::where('id',$request->id)->first();

        $usuario->prestamo = $request->prestamo;
        $usuario->intereses = $request->intereses;
        $usuario->saldo =  $request->prestamo + ($request->prestamo * ($request->intereses/100)) + $usuario->saldoRebajado;
        $usuario->saldoRebajado = $request->prestamo + ($request->prestamo * ($request->intereses/100)) + $usuario->saldoRebajado;

        $usuario->save();

        $valor = $request->metodoPago;

        return redirect()->route("tablaClientes",compact("valor")); 
    }

    public function eliminarAbono(Request $request){

        $abonoEncontrado = Abono::where('id',$request->id)->first(); // abono encontrado

        $deleteAbono = Abono::where('id',$abonoEncontrado->id)->delete(); // abono eliminado
    
        $usuario=Usuario::where('cedula',$abonoEncontrado->cedula)->first(); //obtengo los datos completos del usuario

        $usuario->saldoRebajado = $usuario->saldoRebajado + $abonoEncontrado->abono;

        $usuario->save();

        $abonos=Abono::where('cedula',$usuario->cedula)->get(); //obtengo los datos completos del usuario

        session()->flash("abonoEliminado","Abono eliminado correctamente");

        $abonoUltimo=Abono::where('cedula',$usuario->cedula)->latest()->first(); //obtengo los datos del ultimo abono

        if($abonoUltimo == null){
            return view("Abonos.indexAbono2",compact("usuario","abonos","abonoUltimo"));
        }else{
            return view("Abonos.indexAbono",compact("usuario","abonos","abonoUltimo"));
        }
        
    }
    
    public function tablaClientes(Request $request){
        $tipoPago = $request->valor;
        $txtBuscar = $request->input('txtBuscar');

        $estados = Estado::all();
        $diaSemana = date('N');
        $diaActual = date("d"); // Obtiene el día actual

        //Para obtener la hora actual de Costa Rica
        date_default_timezone_set('America/Costa_Rica'); // Configura la zona horaria a Costa Rica
        $fechaActual = new DateTime(); // Crea un objeto DateTime con la fecha y hora actual en la zona horaria de Nueva York
        $horaActual = $fechaActual->format('H:i'); // Obtiene la hora actual en formato 'HH:mm:ss' en la zona horaria de Nueva York

        
        //si el dia de la semana es miercoles pasar todos los estados "1" a color negro o estado "0"
        //si el dia de la semana es miercoles pasar todos los estados "0" a "-1"
        //si el dia de la semana es miercoles los estados "-1" quedan en "-1"
        $todosUsuarios = Usuario::all();
        foreach($todosUsuarios as $item2){
            if($item2->metodoPago == "Semanal"){
                foreach($estados as $item){
                    if($diaSemana == "3" && $item->estado == 0){
                        $item->estado = -1;
                        $item->save();
                    }
                    else if($diaSemana == "3" && $item->estado == -1){
                        $item->estado = -1;
                        $item->save();
                    }else if($diaSemana == "4" && $item->estado == 1){
                        if($horaActual >= "01:00" && $horaActual <= "04:00"){
                            $item->estado = 0;
                            $item->save();
                        }
                    }
                }
            }
            
            else if($item2->metodoPago == "Quincenal"){
                foreach($estados as $item){
                    if($diaActual == "5" && $item->estado == 0 || $diaActual == "20" && $item->estado == 0){
                        $item->estado = -1;
                        $item->save();
                    }
                    else if($diaActual == "5" && $item->estado == -1 || $diaActual == "20" && $item->estado == -1){
                        $item->estado = -1;
                        $item->save();
                    }else if($diaActual == "6" && $item->estado == 1 || $diaActual == "21" && $item->estado == 1){
                        if($horaActual >= "01:00" && $horaActual <= "04:00"){
                            $item->estado = 0;
                            $item->save();
                        }
                    }
                }
            }
        }
        

        if($tipoPago == null){
            $tipoPago = $request->tipoPago;
            $usuarios = Usuario::where('nombre', 'LIKE', '%'.$txtBuscar.'%')->orderBy('nombre', 'asc')->get();
            return view("PaginaPrincipal.paginaPrincipalTablas",compact("usuarios","txtBuscar","tipoPago","estados"));
        }


        $usuarios = Usuario::where('nombre', 'LIKE', '%'.$txtBuscar.'%')->orderBy('nombre', 'asc')->get();
        return view("PaginaPrincipal.paginaPrincipalTablas",compact("usuarios","txtBuscar","tipoPago","estados"));

    }

}
