<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista con while</h1>
    <?php
        //BUCLE WHILE
        $i = 1;

        echo"<ul>";
        while($i <=10){
            echo "<li>$i</li>";
            $i ++;
        }
        echo "</ul>";

    ?>
    <h1>Lista con while Alternativa</h1>
    <?php
    $i = 1;

    echo"<ul>";
    while($i <=10):
        echo "<li>$i</li>";
        $i ++;
    endwhile;
    echo "</ul>";
    ?>

    <!--EJERCICIO 2: MOSTRAR EN UNA LISTA LOS NUMERO MULTIPLOS DE 3 USANDO WHILE E IF-->
    <!--EJERCICIO 3: CALCULAR LA SUMA DE LOS NUMERO PARES ENTRE 1 Y 20-->
    <!--EJERCICIO 4: CALCULAR EL FACTORIAL DE 6 CON WHILE-->

    <?php
    $i = 1;

        echo"<ul>";
        while($i <= 10){
            echo "<li>$i</li>";
            $i ++;
        }
        echo "</ul>";
    ?>

<h1>Ejercicio for</h1>
<?php

$n = 2;
$numerosPrimos = 0;

echo "<ol>";
while($numerosPrimos < 50) {
    $primo = true;
   for($i = 2; $i <= $n/2; $i++){ //bucle que comprueba si el numero es primo o no
       if($n%$i == 0){
        $primo = false;
        break;
       }
    }
       if($primo){
        $numerosPrimos++;
        echo"<li>$numero<li>";
       }
       $n++;
   }
echo"</ol>";
?>
</body>
</html>