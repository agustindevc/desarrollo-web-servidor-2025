<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <?php
        //crea un array vacio
        $array = [];

        $array2 = [];

        $array3 = [];

        //rellena ambos array con numeros aleatorios
        for($i = 0; $i < 5; $i++){
            $array2 [$i] = rand(1, 10);
            $array3 [$i] = rand(10, 100);
        }
        
    //inserta ambos arrays en el array vacio
    array_push($array, $array2);
    array_push($array, $array3);

    ?>

    <!--Muestro en dos parrafos, los numeros de lso arrays separados por ","-->
    <p>
        <?php        
        for($i = 0; $i < 5; $i++){ 
            echo"$array2[$i], ";
        }
    ?>
    </p>
    <p>
    <?php 
        for($i = 0; $i < 5; $i++){
            echo"$array3[$i], ";
        }
    ?>
    </p>

    <?php

        //Obtener maximo y minimo de cada array
        $max1 = 0;
        $min1 = 11;
        for($i = 0; $i < 5; $i++){
            if($array2[$i] > $max1){
                $max1 = $array2[$i];
            }
            if($array2[$i] < $min1){
                $min1 = $array2[$i];
            }
        }

        $max2 = 0;
        $min2 = 101;
        for($i = 0; $i < 5; $i++){
            if($array3[$i] > $max2){
                $max2 = $array3[$i];
            }
            if($array3[$i] < $min2){
                $min2 = $array3[$i];
            }
        }

        //calcular media del primer array
        $suma1 = 0;
        for($i = 0; $i < 5; $i++){
            $suma1 += $array2[$i];
        }


        //calcular media del segundo array
        $suma2 = 0;
        for($i = 0; $i < 5; $i++){
            $suma2 += $array3[$i];
        }

        
        //calcular media de ambos arrays
        $media1 = ($suma1/5);
        $media2 = ($suma2/5);

        echo"<h2>El maximo del primer array es: $max1</h2>";
        echo"<h2>El minimo del primer array es: $min1</h2>";
        echo"<h2>El maximo del segundo array es: $max2</h2>";
        echo"<h2>El minimo del segundo array es: $min2</h2>";
        echo"<h2>La media del primer array es $media1</h2>";
        echo"<h2>La media del segundo array es $media2</h2>"
    ?>


</body>
</html>