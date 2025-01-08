<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require 'conexion.php'; ?>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  

        //controlo que la sesion este iniciada
        /*session_start(); //colocamos esto para recuperar la sesion
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenido " . $_SESION["usuario"] . "</h2>";
        } else {
            header("location: usuario/iniciar_sesion.php"); //averiguar bien que hace este codigo
            exit;
        }*/
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nuevo Anime</h1>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $titulo = $_POST["titulo"];
            $nombre_estudio = $_POST["nombre_estudio"];
            $anno_estreno = $_POST["anno_estreno"];
            $num_temporadas = $_POST["num_temporadas"];
            $nombre_imagen = $_FILES["imagen"]["name"];
            $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
            $ubicacion_final = "./imagenes/$nombre_imagen";

            move_uploaded_file($ubicacion_temporal, $ubicacion_final);
            /* $_FILES -> es un array bidimensional*/

            //var_dump($_FILES["imagen"]);

            /*
            $sql = "INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas, imagen)
                VALUES ('$titulo', '$nombre_estudio', $anno_estreno, $num_temporadas, '$ubicacion_final')";

                $_conexion -> query($sql); //indico donde debe guardarse.
            */

            //Las tres etapas de las prepared statements (Preparacion, ENlazado (binding). Ejecucion).

            //1-Preparacion
            $sql = $_conexion -> prepare("INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas, imagen)
                VALUES (?,?,?,?,?)");

            //2-Enlazado
            $sql -> bind_param("ssiis",
            $titulo,
            $nombre_estudio,
            $anno_estreno,
            $num_temporadas,
            $ubicacion_final); //se debe indicar el tipo de dato que se ingresara, EN ORDEN: s (strig), i(int)...
        
            //3-Ejecución
            $sql -> execute();

            

        }

        //como obtener un dato especifico de la tabla para mostrarlo o utilizarlo como necesite. en neste caso, apra crear un select con todos los nombre de estudio que hayaa en la tabla
        $sql = "SELECT * FROM estudios ORDER BY nombre_estudio";
        $resultado = $_conexion -> query($sql);


        //cierro la base de datos
        $_conexion -> close();


        $estudios = []; //Aqui se añadiran los nombres de los estudios que se encuentren en la base de datos
        
        while($fila = $resultado -> fetch_assoc()) {
            array_push($estudios, $fila["nombre_estudio"]);
        }
        
        ?>

        <form action="" method="post" enctype="multipart/form-data"> <!--Se agrega el enctype para que pueda leer imagenes?? -->
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input class="form-control" type="text" name="titulo">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre estudio</label>
                <select class="form-select" name="nombre_estudio">
                    <option value="" selected disabled hidden>--Elige el estudio--</option>
                    <?php
                    foreach($estudios as $estudio) { ?>
                        <option value="<?php echo $estudio ?>">
                            <?php echo $estudio ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Año estreno</label>
                <input class="form-control" type="text" name="anno_estreno">
            </div>
            <div class="mb-3">
                <label class="form-label">Numero de temporadas</label>
                <input class="form-control" type="text" name="num_temporadas">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Insertar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>