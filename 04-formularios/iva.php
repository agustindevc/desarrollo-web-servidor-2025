<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iva</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    

        require ('../05_funciones/iva.php');
    ?>
</head>
<body>
    <!--GENERAL = 21% 
        REDUCIDO = 10%
        SUPERREDUCIDO = 4%
        10EUROS IVA = GENERAL; PVP = 12,1EUROS
        10EUROS IVA = REDUCIDO,PVP = 11EUROS 
    -->
    <form action="" method="post">
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

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $tmp_precio = $_POST["precio"];
        $tmp_iva = $_POST["iva"];
            
        if($tmp_precio == '') {
            echo "<p>El salario es obligatorio</p>";
        } else {
            if(filter_var($tmp_precio, FILTER_VALIDATE_FLOAT) === FALSE) { //Filtro para validar si el dato introducido en salario es correcto. FLOAT porque puede contener decimales
                echo "<p>El salario debe ser un número</p>";
            } else {
                if($tmp_precio < 0) {
                    echo "<p>El salario debe ser mayor o igual que cero</p>";
                } else {
                    $precio = $tmp_precio;
                }
            }
        }

        if($tmp_iva == ''){
            echo"<h2>El iva es obligatorio</h2>";
        } else {
            $valores_validos_iva = ["general", "reducido", "superreducido"]; //CREO UN ARRAY CON LAS POSIBLES OPCIONES

            //compruebo si la opcion elegida esta en el array
            if(!in_array($tmp_iva, $valores_validos_iva)) {
                echo "<P>El IVA solo puede ser: GENERAL, REDUCIDO O SUPERREDUCIDO</P>";
            } else {
                $iva = $tmp_iva; //si esta en el array (opciones) le asigno el valor a la variable $iva
            }
        }

        //si las variables existen en este punto, ejecuto la funcion
        if(isset($precio) && isset($iva)){
            echo calcularIva($precio, $iva);
        }
    }
    
    ?>
</form>
</body>
</html>