<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays bidimensionales</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
</head>
<body>
    <?php
    $videojuegos = [
        ["Disco Elysium", "RPG", 9.99],
        ["Dragon Ball Z Kakarot", "Accion", 59.99],
        ["Persona 3", "RPG", 24.99],
        ["Commando 2", "Estrategia", 4.99],
        ["Hollow Knight", "Metroidvania", 9.99],
        ["Stardew VAlley", "Gestion de recursos", 7.99],
    ];

    //como agregar un elemento al array
    $nuevo_videojuego = ["Octopath Traveler", "RPG", 29.95];
    array_push($videojuegos, $nuevo_videojuego);

    //otra forma
    array_push($videojuegos, ["Ender Liles", "Metroidvania", 9.95]);
    
    array_push($videojuegos, ["Dota 2","MOBA", 0]);
    array_push($videojuegos, ["Fall Guys","Plataforma", 0]);
    array_push($videojuegos, ["Rocket League","Deporte", 0]);
    array_push($videojuegos, ["Lego Fortnite","Accion", 0]);


    //COMO AÑADIR UNA COLUMNA AL ARRAY
    for($i = 0; $i < count($videojuegos); $i++){
        if($videojuegos[$i][2] == 0){
            $videojuegos[$i][3] = "gratuito";
        }
        else{
            $videojuegos[$i][3]= "pago";
        }
    }

    //como eliminar un elemento del array
    unset($videojuegos[3]); //DE ESTA MANERA AL ELIMINAR EL 3, DESAPARECE TAMBIEN EL IDNCIE 3.
    //SE DEBE REALIZAR UN ARRAY VALUES PARA REORDENAR LOS INDICES.


    //SI QUIERO REORDENAR DE FORMA ASCENDENTE
    $_titulo = array_column($videojuegos, 0); //entre parentesis le indico el array y la columna que quiero utilizar
    array_multisort($_titulo, SORT_ASC, $videojuegos);


    $_titulo = array_column($videojuegos, 0);
    $_categoria = array_column($videojuegos, 1);
    $_precio = array_column($videojuegos, 2);
    //SI FUERA DESCENDIENTE SORT_DESC
    array_multisort($_categoria, SORT_ASC,
                    $_precio, SORT_DESC,
                    $_titulo, SORT_DESC,
                    $videojuegos); //se recomienda ordenar por todos los campos para evitar ambiguedades, va a dar prioridad a lo que pongamos primero

    //LAS VARIABLES QUE HE CREADO PARA EL REORDENAMIENTO NO PUEDO VOLVER A UTILIZARLAS. SE DEBEN VOVLER A DECLARAR
    
    
    ?>

    <table>
        <thead>
            <tr>
                <th>Videojuego</th>
                <th>Categoria</th>
                <th>Precio</th>
                <th>Condicion</th>
                <th>Duracion</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($videojuegos as $videojuego){
                //print_r($videojuego);
                //echo "<br><br>";

                //otra forma
                list($titulo, $categoria, $precio, $condicion, $duracion) = $videojuego; //esta funcion descomone el array en varia variables.
                echo "<tr>";
                echo"<td>$titulo</td>";
                echo"<td>$categoria</td>";
                echo"<td>$precio</td>";
                echo"<td>$condicion</td>";
                echo"<td>$duracion</td>";
                echo"<td>$tipo</td>";
                echo"</tr>";

            }
            ?>
        </tbody>
    </table>
    
</body>
</html>