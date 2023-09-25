<?php

namespace App\Console\Commands;

use App\Models\Estado;
use App\Models\Usuario;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class Quincenal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:Quincenal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Request $request)
    {
        //comando para que se ejecute para siempre esto se debe pegar donde uno hace el pull en EC2
        //nohup php artisan schedule:work > /dev/null 2>&1 &
        //comando para detener ese comando schedule:work
        //ps aux | grep "php artisan schedule:work"
        //me tira un pid un numero y debo escribirlo aqui como este ejemplo
        //kill 12345


        
        $estados = Estado::all();
        $diaSemana = date('N');
        $diaActual = date("d"); // Obtiene el día actual


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
                        $item->estado = 0;
                        $item->save();
                    }
                }
            }
        }
            
            
        foreach($todosUsuarios as $item2){
             if($item2->metodoPago == "Quincenal"){
                foreach($estados as $item){
                    if($diaActual == "5" && $item->estado == 0 || $diaActual == "20" && $item->estado == 0){
                        $item->estado = -1;
                        $item->save();
                    }
                    else if($diaActual == "5" && $item->estado == -1 || $diaActual == "20" && $item->estado == -1){
                        $item->estado = -1;
                        $item->save();
                    }else if($diaActual == "6" && $item->estado == 1 || $diaActual == "21" && $item->estado == 1){
                        $item->estado = 0;
                        $item->save();
                    }
                }
            }
        }
    }


}
