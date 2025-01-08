<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números</title>
</head>
<body>
    <?php

        //tres formas de hacer un if:
        $numero = 1;

        //forma 1
        if($numero > 0) {
            echo"<p>El numero $numero es mayor que cero</p>";

        }
        
        //forma 2
        if($numero < 0) echo"<p>El numero $numero es menor que cero</p>";


        //forma 3
        if($numero == 0):
            echo"<p>El numero $numero es igual que cero</p>";
        endif;

        //if con else (tambien hay tres formas)
        $numero = 0;
        //forma 1
        if($numero > 0) {
            echo"<p>El numero $numero es mayor que cero</p>";
        }elseif ($numero < 0){
            echo"<p>El numero $numero es menor que cero</p>";
        }
        else{
            echo"<p>El numero $numero es igual que cero</p>";
        }

        //forma2
        if($numero > 0) echo"<p>El numero $numero es mayor que cero</p>";
        elseif ($numero < 0) echo"<p>El numero $numero es menor que cero</p>";
        else echo"<p>El numero $numero es igual que cero</p>";

        //forma3
        if($numero > 0):
            echo"<p>El numero $numero es mayor que cero</p>";
        elseif ($numero < 0):
            echo"<p>El numero $numero es menor que cero</p>";
        else:
            echo"<p>El numero $numero es igual que cero</p>";
        endif;
        ?>

        <?php
            #rango [-10,0],[0,10],[10,20]
            $num = -7;

            #Forma1
            if($num >= -10 && $num <= 0){
                echo"<p>El numero $num está en el rango [-10,0]</p>";
            }elseif($num >= 0 && $num <= 10) {
                echo"<p>El numero $num está en el rango [0,10]</p>";
            }elseif($num >= 10 && $num <= 20) {
            echo("<p>El numero $num está en el rango [10,20]</p>");
            }else{
                echo("<p>El numero $num esta fuera de rango</p>");
            }
            
            #Forma2
            if($num >= -10 && $num <= 0) echo"<p>El numero $num esta en el rango [-10,0]</p>";
            elseif($num >= 0 && $num <=10) echo"<p>El numero $num esta en el rango [0,10]</p>";
            elseif($num<=10 && $num <=20) echo"<p>El numero &num  esta en el rango [10,20]</p>";
            else echo"<p>EL numero $num esta fuera de rango</p>";

            #Forma3
            if($num >= -10 && $num <= 0):
                echo"<p>El numero $num esta en el rango [-10,0]</p>";
            elseif($num >= 0 && $num <=10):
                echo"<p>El numero $num esta en el rango [0,10]</p>";
            elseif($num<=10 && $num <=20):
                echo"<p>El numero &num  esta en el rango [10,20]</p>";
            else:
                echo"<p>EL numero $num esta fuera de rango</p>";
            endif;


            /*COMPROBAR DE TRES FORMAS DIFERENTES, CON LA ESTRUCTURA IF, SI EL NUMERO ALEATORIO TIENE 1, 2 Ò 3 CIFRAS:*/
            #funcion rand (numeros aleatorios):

            $numero_aleatorio = rand (1,200); //Incluye tanto el 1 como el 200, y son enteros.

            //Para numeros alearotios decimales:

            //$numero_aleatorio_decimales = rand(10,100)/10;

            #Forma 1
            if ($numero_aleatorio > 0 && $numero_aleatorio < 10):
                echo("<p>El numero tiene 1 cira</p>");
            elseif ($numero_aleatorio > 9 && $numero_aleatorio < 100):
                echo("<p>El numero tiene 2 cifras</p>");
            elseif ($numero_aleatorio > 99):
                echo("<p>El numero tiene 3 cifras</p>");
            endif;

            #Forma 2
            if ($numero_aleatorio > 0 && $numero_aleatorio < 10){
                echo("<p>El numero tiene 1 cira</p>");
            }
            elseif ($numero_aleatorio > 9 && $numero_aleatorio < 100){
                echo("<p>El numero tiene 2 cifras</p>");
            }
            elseif ($numero_aleatorio > 99){
                echo("<p>El numero tiene 3 cifras</p>");
            }

            #Forma 3
            if ($numero_aleatorio > 0 && $numero_aleatorio < 10): echo("<p>El numero tiene 1 cira</p>");

            elseif ($numero_aleatorio > 9 && $numero_aleatorio < 100): echo("<p>El numero tiene 2 cifras</p>");
            
            elseif ($numero_aleatorio > 99): echo("<p>El numero tiene 3 cifras</p>");
            endif;

            #Para no repetir codigo se puede crear una variable que guarde cas cifras y luego imprimirlo en un mensaje:
            $cifras = 0;
            if ($numero_aleatorio > 0 && $numero_aleatorio < 10):
                $cifras = 1;
            elseif ($numero_aleatorio > 9 && $numero_aleatorio < 100):
                $cifras = 2;
            elseif ($numero_aleatorio > 99):
                $cifras = 3;
            endif;

            echo("<p>EL numero tiene $cifras cifras.</p>");
            

            // VERSION CON MATCH
            $resultado = match(true){
                $numero_aleatorio  >= 1 && $numero_aleatorio <= 9 => 3,
                $numero_aleatorio >= 10 && $numero_aleatorio <= 99 => 2,
                $numero_aleatorio >= 100 && $numero_aleatorio <= 999 => 3,
                default => "ERROR"
            };

            echo "<h1>El numero tiene $cifras cifras</h1>"
        ?>
</body>
</html>