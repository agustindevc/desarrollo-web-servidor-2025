<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <?php

    //crea un array de animes
    $animes = [
        ["Anime 1 nombre", "Anime 1 genero"],
        ["Anime 2 nombre", "Anime 2 genero"]
    ];

    unset($animes[0]); //Desaparece el indice 0

    //Añade una tercera columna al array (año de estreno random entre 1990 y 2030)
    for($i = 0; $i < count($animes); $i++){
        $animes[$i][3] = rand (1990,2030);
    }

    //Añade una cuarta columna al array (numero de episodios)
    for($i = 0; $i < count($animes); $i++){
        $animes[$i][4] = rand (1,99);
    }

    //Añade una quinta columna al array (estrenado o no)
    for($i = 0; $i < count($animes); $i++){
        if($animes[$i][3] <= 2024){
            $animes[$i][5] = "Ya disponible";
        }else{
            $animes[$i][5] = "Proximamente";
        }
    }

    
    //ordena los animes: género, año, titulo
    /*$_titulo = array_column($animes, 0);
    $_genero = array_column($animes, 1);
    $_anno = array_column($animes, 2);


    array_multisort($_genero, SORT_ASC,
                    $_anno, SORT_ASC,
                    $_titulo, SORT_ASC,
                    $animes);*/
                    
    ?>

    <table>
        <thead>
            <tr>
                <td>Titulo</td>
                <td>Genero</td>
                <td>Año</td>
                <td>Episodios</td>
                <td>Disponibilidad</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            foreach($animes as $anime){

                list($titulo, $genero, $anno, $episodios, $disponible) = $anime;
                echo "<tr>";
                echo"<td>$titulo</td>";
                echo"<td>$genero</td>";
                echo"<td>$anno</td>";
                echo"<td>$episodios</td>";
                echo"<td>$disponible</td>";
                echo"</tr>";
            }     
            ?>
        </tbody>
    </table>
</body>
</html>