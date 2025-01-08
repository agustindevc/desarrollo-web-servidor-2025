<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <form action="" method="post"> <!--No se coloca nada entre comillas de action porque es autopage-->
        <input type="text" name="mensaje"> <!--"mensaje es el nombre de la etiqueta, sirve para llamarlo despues"-->
        <input type="text" name="numero">
        <input type="submit" value="Enviar"> <!--Boton de enviar-->
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") { /*Este codigo se ejecuta cuando el servidor recibe una peticion POST*/

        $mensaje = $_POST["mensaje"]; /*capturo en una variable el mensaje de input "mensaje"*/
       
        //añadir al formulario un campo de texto adicional para introducir un numero
        $numero = $_POST["numero"];

        //mostrar el mensaje tantas veces como indique el numero
        for($i = 0; $i < $numero; $i++){
            echo "<h1>$mensaje</h1>";
        }
        //añadir al formulario un campo de texto adicional para introducir un numero
        //mostrar el mensaje tantas veces como indique el numero


    }
    ?>
</body>
</html>