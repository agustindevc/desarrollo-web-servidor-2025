<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );   
        
    ?>
</head>
<body>
    <!--CREAR UN FOMRULARIO QUE RECIBA EL NOMBRE Y EDAD DE UNA PERSONA
        SI LA EDAD ES MENOR QUE 18, SE MOSTRARA EL NOMBRE

        SI LA EDAD ESTA ENTRE 18 Y 65, SE MOSTRARA EL NOMBRE YQ UE ES MAYOR DE EDAD
        SI LA EDAD ES MAS DE 65, SE MOSTRARA EL NOMBRE Y QUE SE HA JUBILADO

    -->

    <form action="" method="post"> <!--No se coloca nada entre comillas de action porque es autopage-->
        <label for="nombre">Nombre</label>    
        <input type="text" name="nombre">
        <label for="edad">Edad</label>    
        <input type="text" name="edad"> <!--"mensaje es el nombre de la etiqueta, sirve para llamarlo despues"-->
        <input type="submit" value="Enviar"> <!--Boton de enviar-->
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $edad = $_POST["edad"];

            if($edad < 18 && $edad > 0){
                echo"<h1>$nombre Es menor de edad</h1>";
            }
            elseif($edad >= 18 && $edad < 65){
                echo"<h1>$nombre Es mayor de edad</h1>";
            }
            elseif($edad >= 65){
                echo"<h1>$nombre Se ha jubilado</h1>";
            }
            else{
                echo"<h1>dato invalido</h1>";
            }
        }

        /*OTRA FORMA DE HACERLO CON MATCH*/

        /*
        $resultado = match(true){
            $edad < 18 => "es menor de edad",
            $edad >= 18 and $edad <=65 => "es mayor de edad",
            $edad > 65 => "se ha jubilado"
        };
        echo "<h1>$nombre $resultado</h1>";*/
    ?>
</body>
</html>