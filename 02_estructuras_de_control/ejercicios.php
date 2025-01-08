<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>

<!--EJERCICIO 1: MOSTRAR LA FECHA ACTUAL CON EL SIGUIENTE FORMATO:
        Viernes 27 de Septiembre de 2024
    UTILIZAR LAS ESTRUCTURAS DE CONTROL NECESARIAS-->
    <?php
    $day = date("l");
    $day_number = date("j") ;
    $month = date("n");
    $anio = date("Y");

    $day = match($day){
        "Monday" => "Lunes",
        "Tuesay" => "Martes",
        "Wednesday" => "Miercoles",
        "Thursday" => "Jueves",
        "Friday" => "Viernes",
        "Saturday" => "Sabado",
        "Sunday" => "Domingo",
    };

    $month = match($month){
        "1" => "Enero",
        "2" => "Febrero",
        "3" => "MArzo",
        "4" => "Abril",
        "5" => "Mayo",
        "6" => "Junio",
        "7" => "Julio",
        "8" => "Agosto",
        "9" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre",
    };

    echo "<h1>$day $day_number de $month de $anio</h1>";

    ?>
<!--EJERCICIO 2: MOSTRAR EN UNA LISTA LOS NUMEROS MULTIPLOS DE 3 USANDO WHILE E IF-->


<ul> //inicializacion de la lista en HTML
<?php
$i = 0;

while($i <= 20){

    if($i%3 == 0){
        echo "<li>$i</li>";
    }

    $i++; //incremento
}
?>
</ul>

<!--EJERCICIO 3: CALCULAR LA SUMA DE LOS NUMEROS PARES ENTRE 1 Y 20-->

"<ul>"; //inicializacion de la lista en HTML
<?php

    $i = 0;
    $suma = 0;

    while($i <= 20){

        if($i%2 == 0){
            $suma += $i;            
        }

        $i++; //incremento
    }
?>
</ul>

<!--EJERCICIO 4: CALCULAR EL FACTORIAL DE 6 CON WHILE-->

<?php


$factorial = 6;
$resultado = 1;
$i = 1;
while($i <= $factorial){
    $resultado *= $i;
    $i++;
}
echo "<p>SOLUCION: EL FACTORIAL DE $factorial ES $resultado</p>"



?>

<!--MISMO EJERCICIO CON FOR-->
<?php

for($i = 6; $i = 0; $i--):
    $factorial *= $i;

echo"el factorial de 6 es: $factorial";

?>


<!--BUCLES FOR -->

<h1>Lista con for</h1>
<?php echo "<ul>";
for($i = 1; $i <= 10; $i++):
    echo"<li>$i</li>";
echo "</ul>";

?>

<!--LISTA CON FOR CON BREAK CURSED-->

<h1>LISTA CON FOR CON BREAK cursed</h1>

<h1>
<?php
echo "<ul>";
for($i = 1; ; $i++){
    if($i > 10){
        break;
    }
    echo "<li>$i</li>";
    $i++;
}

?>
<h3>EJERCICIO 5</h3>
<p>MUESTRA POR PANTALLA LOS 50 PRIMERO NUMERO PRIMOS</p>

<h1>
<?php
/**
 *  4 % 1 = 0 4 NO ES PRIMO
 *  4 % 2 = 2
 *  4 % 3 = 1
 *  4 % 4 = 0
 * 
 *  5 % 2 = 0
 *  5 % 3 = 2
 *  5 % 4 = 1
 * 
 * BUCLE DE 2 A N-1
 */


 $n = 7;

 for($j = 0; $j= 50; $j++){
    for($i = 2; $i = $n-1; $i++){
        if($n%$i == 0):
            break;
        endif;
    echo"<li>$i</n>";
    }
}
 ?>

</h1>
</body>
</html>