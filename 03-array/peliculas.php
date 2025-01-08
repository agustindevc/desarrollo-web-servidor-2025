<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    $peliculas = [
        ["Karate a muerte en Torremolinos", "Accion", 1975],
        ["Sharknado 1-5", "Accion", 2015],
        ["Princesa por sorpresa 2", "Comedia", 2008],
        ["Temblores 4", "Terror", 2018],
        ["Cariño, he encogido a los niños", "Aventuras", 2001],
        ["Stuart Little", "Infantil", 2000],
    ];
    ?>

<table>
        <thead>
            <tr>
                <th>Pelicula</th>
                <th>Genero</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($peliculas as $pelicula){
                list($titulo, $genero, $anno)= $pelicula;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$genero</td>";
                echo "<td>$anno</td>";
                echo "</tr>";            }
            ?>
        </tbody>
    </table>

    /**
     * 1. AÑADIR CON UN RAND, LA DURACION DE CADA PELICULA.
     * LA DURACION SERA UN NUMERO ALEATORIO ENTRE 30 Y 240
     * 
     */
    ?>
    <?php
    
     for($i = 0; $i < count($peliculas); $i++) {
        $peliculas[$i][3] = rand(30, 240);

        if($peliculas[$i][3] < 60){
            $peliculas[$i][4] = "CORTOMETRAJE";
        } else {
            $peliculas[$i][4]= "LARGOMETRAJE";
        }
    }

     $_titulo = array_column($peliculas, 0);
     $_genero = array_column($peliculas, 0);
     $_anno = array_column($peliculas, 0);


     array_multisort($_genero, SORT_ASC, $_anno, SORT_DESC, $_titulo, SORT_ASC, $peliculas);
     


     /* 
     * 2. AÑADIR COMO UNA NUEVA COLUMNA, EL TIPO DE PELICULA. EL TIPO
     * SERA CORTOMETRAJE SI LA DURACION ES MENOR QUE 60
     * Y LARGOMETRAJE SI LA DURACION ES MAYOR O IGUAL QUE 60.
     */



     /* 3. MOSTRAR EN OTRA TABLA, TODAS LAS COLUMNAS Y ORDENAR ADEMAS EN ESTE ORDEN
     *      1. GENERO
     *      2. AÑO
     *      3. TITULO (TODO ALFABETICAMENTE, Y EL AÑO DE MAS RECIENTE A MAS ANTIGUO).
     */
    ?>

<table>
        <thead>
            <tr>
                <th>Pelicula</th>
                <th>Genero</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($peliculas as $pelicula){
                list($titulo, $genero, $anno)= $pelicula;
                echo "<tr>";
                echo "<td>$titulo</td>";
                echo "<td>$genero</td>";
                echo "<td>$anno</td>";
                echo "</tr>";            }
            ?>
        </tbody>
    </table>


</body>
</html>