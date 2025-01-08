<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <form action=""  method="post">
        <label for="numero">Numero</label>
        <input type="text" name="numero">
        <select name="opciones">
            <option value="sumatorio">Sumatorio</option>
            <option value="factorial">Factorial</option>
            <input type="submit" value="Calcular">
        </select>
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
                $numero = $_POST["numero"];
                $opcion = $_POST["opciones"];


            $factorial = $numero;
            $fin = 1;
            $i = 1;
            while($i <= $factorial){
                $fin *= $i;
                $i++;
            }

            $suma = 0;
            for($i = 0; $i < $numero; $i++ ){
                $suma += $i;
            }

            $resultado = match($opcion){
                "factorial" => $fin,
                "sumatorio" => $suma
            };
            echo $resultado;
        }
    ?>

    </form>

</body>
</html>