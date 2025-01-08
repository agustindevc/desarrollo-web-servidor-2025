<?php
    function calcularIva(int|float $precio, string $iva){
        if($precio != ''and $precio != ''){
            $precioIva = match($iva){
                "general" => $precio * GENERAL, //ALMACENA EN precioIva EL RESULTADO DE LA CUETNA AL SELECCIONAR GENERAL
                "reducido" => $precio * REDUCIDO,
                "superreducido" => $precio * SUPERREDUCIDO,
            };   
            echo "<h2>El precio con iva es $precioIva</h2>";
        } else{
            echo "<h2>Te faltan datos</h2>";
        }
    }

    function calcularPVP($precio, $iva){
        $precioIva = match($iva){
            "general" => $precio * GENERAL, //ALMACENA EN precioIva EL RESULTADO DE LA CUETNA AL SELECCIONAR GENERAL
            "reducido" => $precio * REDUCIDO,
            "superreducido" => $precio * SUPERREDUCIDO,
        };   
        
        return $precioIva;
    }

?>