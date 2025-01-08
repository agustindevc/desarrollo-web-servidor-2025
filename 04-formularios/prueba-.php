<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tmp_fecha = $_POST["fecha"];

    if($tmp_fecha == ""){
        $err_fecha = "La fecha es obligatoria";
    } else {
        list($anno,$mes,$dia) = explode("-",$tmp_fecha);
        if($anno > 2025){
            $err_fecha = "La fecha no puede ser posterior al 15-07-2025";
        }elseif($anno == 2025){
            if($mes > 07){
                $err_fecha = "La fecha no puede ser posterior al 15-07-2025";
            }elseif($mes == 07){
                if($dia > 15){
                    $err_fecha = "La fecha no puede ser posterior al 15-07-2025";
                } else {
                    $fecha = $tmp_fecha;
                }
            }else {
                $fecha = $tmp_fecha;
            }
        }else {
            $fecha = $tmp_fecha;
        }
    }
}