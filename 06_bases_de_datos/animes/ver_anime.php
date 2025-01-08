<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar animes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require 'conexion.php'; ?>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  

        //controlo que la sesion este iniciada
        session_start(); //colocamos esto para recuperar la sesion
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenido " . $_SESION["usuario"] . "</h2>";
        } else {
            header("location: usuario/iniciar_sesion.php"); //averiguar bien que hace este codigo
            exit;
        }
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar animes</h1>
        <?php
        echo "<h1>" . $_GET["id_anime"] . "</h1>"; //trae mediante el get y muestra la id del anime que estyoy editando

        $id_anime = $_GET["id_anime"]; //traigo el id del anime y lo almaceno en la variable
        $sql = "SELECT * FROM animes WHERE id_anime = $id_anime"; //cogemos la informacion del anime que contenga esa id
        $resultado = $_conexion -> query($sql); //almaceno la informacion en la variable resultado.
  
       
        while($fila = $resultado -> fetch_assoc()){ //estructura para separar la informacion en variables
            $titulo = $fila["titulo"];
            $nombre_estudio = $fila["nombre_estudio"];
            $anno_estreno = $fila["anno_estreno"];
            $num_temporadas = $fila["num_temporadas"];
            $imagen = $fila["imagen"];
        }

        //como obtener un dato especifico de la tabla para mostrarlo o utilizarlo como necesite. en neste caso, apra crear un select con todos los nombre de estudio que hayaa en la tabla
        $sql = "SELECT * FROM estudios ORDER BY nombre_estudio";
        $resultado = $_conexion -> query($sql);

        $estudios = []; //Aqui se añadiran los nombres de los estudios que se encuentren en la base de datos
        
        while($fila = $resultado -> fetch_assoc()) {
            array_push($estudios, $fila["nombre_estudio"]);
        }

        //CAPTURAMOS LOS NUEVOS CAMPOS
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_anime = $_POST["id_anime"];
            $titulo = $_POST["titulo"];
            $nombre_estudio = $_POST["nombre_estudio"];
            $anno_estreno = $_POST["anno_estreno"];
            $num_temporadas = $_POST["num_temporadas"];

            //MODIFICAMOS EL ANIME EN LA BASE DE DATOS CON LOS NUEVOS CAMPOS
            $sql = "UPDATE animes SET
                titulo = '$titulo',
                nombre_estudio = '$nombre_estudio',
                anno_estreno = $anno_estreno,
                num_temporadas = $num_temporadas
                WHERE id_anime = $id_anime
                ";

                $_conexion -> query($sql);
        }
        
        ?>

        <form action="" method="post" enctype="multipart/form-data"> <!--Se agrega el enctype para que pueda leer imagenes?? -->
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input class="form-control" type="text" name="titulo" value="<?php echo $titulo ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre estudio</label>
                <select class="form-select" name="nombre_estudio">
                    <option value="<?php echo $nombre_estudio ?>" selected disabled hidden>--Elige el estudio--</option>
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
                <input class="form-control" type="text" name="anno_estreno" value="<?php echo $anno_estreno ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Numero de temporadas</label>
                <input class="form-control" type="text" name="num_temporadas" value="<?php echo $num_temporadas ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
            </div>
            <div class="mb-3">
                <input type="hidden" name="id_anime" value="<?php echo $id_anime ?>">
                <input class="btn btn-primary" type="submit" value="Confirmar cambios">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
            
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>