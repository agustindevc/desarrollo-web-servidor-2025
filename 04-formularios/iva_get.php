<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iva</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <!--GENERAL = 21% 
        REDUCIDO = 10%
        SUPERREDUCIDO = 4%
        10EUROS IVA = GENERAL; PVP = 12,1EUROS
        10EUROS IVA = REDUCIDO,PVP = 11EUROS 
    -->
    <form action="" method="GET">
        <label for="precio">Precio</label>
        <input type="text" name="precio" id="precio">
        <br><br>
        <select name="iva">
            <option value="general">General</option>
            <option value="reducido">Reducido</option>
            <option value="superreducido">Superreducido</option>
        </select>
        <br><br>
        <input type="submit" value="Calcular">
    

    <?php

    //DEFINICION DE VARIABLES DE IVA. AL SER CONSTANTES DEBERIAN HACERSE DENTRO DEL HEAD
    define("GENERAL", 1.21);
    define("REDUCIDO", 1.21);
    define("SUPERREDUCIDO", 1.21);

    if(isset($_GET["precio"]) and isset($_GET["iva"])){
            $precio = $_GET["precio"];
            $iva = $_GET["iva"];

            //var_dump($precio);
            //var_dump($iva);

            if($precio != ''and $precio != ''){
                $precioIva = match($iva){
                "general" => $precio * GENERAL, //ALMACENA EN precioIva EL RESULTADO DE LA CUETNA AL SELECCIONAR GENERAL
                "reducido" => $precio * REDUCIDO,
                "superreducido" => $precio * SUPERREDUCIDO,
            };  
            echo "<h2>El precio con iva es $precioIva</h2>";
        } else {
            echo"<p>Te faltan datos</p>";
        }
    }
    ?>
</form>
</body>
</html>