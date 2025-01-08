<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    

        require('../05_funciones/temperaturas.php'); //IMPORTACION DEL FICHERO CON LA FUNCION
        require('../05_funciones/edades.php'); 

    ?>
</head>
<body>
    
<h1>Formulario temperaturas</h1>
<form action="" method="post">
        <label>Temperatura original</label>
        <input type="text" name="temperatura"><br><br>
        <label>Unidad original</label>
        <select name="inicial">
            <option value="C">Celsius</option>
            <option value="K">Kelvin</option>
            <option value="F">Fahrenheit</option>
        </select><br><br>
        <label>Unidad final</label>
        <select name="final">
            <option value="C">Celsius</option>
            <option value="K">Kelvin</option>
            <option value="F">Fahrenheit</option>
        </select>
        <br><br>
        <input type="hidden" name="accion" value="formulario_temperaturas"> <!--Coloco un campo escondido para indicarle un nombre al fomulario, que luego utilizare en el if--> 
        <input type="submit" value="Convertir">
    </form>


    <h1>Formulario edades</h1>
    <form action="" method="post"> <!--No se coloca nada entre comillas de action porque es autopage-->
        <label for="nombre">Nombre</label>    
        <input type="text" name="nombre" id="nombre">
        <br><br>
        <label for="edad">Edad</label>    
        <input type="text" name="edad" id="edad"> <!--"mensaje es el nombre de la etiqueta, sirve para llamarlo despues"-->
        <br><br>
        <input type="hidden" name="accion" value="formulario_edades">
        <input type="submit" value="Enviar"> <!--Boton de enviar-->
    </form>


    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Formulario edades
        if($_POST["accion"] == "formulario_edades") {
            $nombre = $_POST["nombre"];
            $edad = $_POST["edad"];
        }
        //Formulario temperaturas
        if($_POST["accion"] == "formulario_temperaturas") {
            $temperatura = $_POST["temperatura"];
            $inicial = $_POST["inicial"];
            $final = $_POST["final"];

            //validacion de datos
            if($temperatura != ''){ //comprobamos que haya algo en el campo
                if(is_numeric($temperatura)){ //luego comprobamos que el tipo de dato sea correcto
                    if($inicial == "C" and $temperatura >= -273.15){
                        echo convertirTemperatura($temperatura, $inicial, $final);
                    } elseif ($inicial == "C" and $temperatura < -273.15) {
                        echo"<p>La temperatura no puede ser inferior a -273.15 C</p>";
                    }
                    if($inicial == "K" and $temperatura >= 0){
                        echo convertirTemperatura($temperatura, $inicial, $final);
                    } elseif ($inicial == "K" and $temperatura < 0) {
                        echo"<p>La temperatura no puede ser inferior a 0 KC</p>";
                    }
                    if($inicial == "F" and $temperatura >= -459.67){
                        echo convertirTemperatura($temperatura, $inicial, $final);
                    } elseif ($inicial == "F" and $temperatura < -459.67) {
                        echo"<p>La temperatura no puede ser inferior a -459.67 K</p>";
                    }
                } else {
                    echo"<p>La temperatura debe ser un numero</p>";
                }
            }else {
                echo"<p>Falta temperatura</p>";
            }
        }
    }

    ?>
    
</body>
</html>