<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo producto</title>
    <link rel="stylesheet" href="../estilo.css">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');

        /*//Controlo que se haya iniciado sesion
        session_start();
        if(isset($_SESSION["usuario"])) {
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] . "</h2>";
        }else{
            header("location: usuario/iniciar_sesion.php");
            exit;
        }*/
    ?>
</head>
<body>
    <div class="container">
        <h1>Nuevo Producto</h1>
        <?php

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_nombre = $_POST["nombre"];
            $tmp_precio = $_POST["precio"];
            $tmp_categoria = isset($_POST["categoria"]) ? $_POST["categoria"] : ""; //Utilizpo el operador ternario (si el campo fue enviado devuelve su valor, sino lo asigna vacio)
            $tmp_stock = $_POST["stock"];
            $nombre_imagen = $_FILES["imagen"]["name"];
            $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
            $ubicacion_final = "../imagenes/$nombre_imagen";

            move_uploaded_file($ubicacion_temporal, $ubicacion_final);
            
            $tmp_descripcion = $_POST["descripcion"];

            //Validacion de datos de nombre
            if($tmp_nombre == ""){
                $err_nombre = "El nombre del producto es obligatorio.";
            } else {
                //Compruebo que el formato sea el correcto.
                $patron = "/^[A-Za-z0-9 ]{2,50}$/";
                if(!preg_match($patron,$tmp_nombre)){
                    $err_nombre = "El nombre debe tener minimo 2 caracteres y maximo 50. SOlo puede tener letras, numeros y espacios en blanco."; 
                }else{
                    //Si todo es correcto, asigno el valor a la variable final.
                    $nombre = $tmp_nombre;
                }
            }

            //Validacion de datos de categoria
            if($tmp_categoria == ""){
                $err_categoria = "Debes seleccionar una categoria.";
            } else {
                $categoria = $tmp_categoria;
            }

            //validacion de datos de precio
            if($tmp_precio == ""){
                $err_precio = "El precio del producto es obligatorio.";
            } else {
                //Compruebo que el formato sea el correcto.
                $patron = "/^(\d{1,4}(\.\d{1,2})?)$/";
                if(!preg_match($patron, $tmp_precio)){
                    $err_precio = "El precio debe ser minimo 0 y maximo 9999,99 y tiene que ser un numero.";
                }else{
                    //Si todo es correcto, asigno el valor a la variable final.
                    $precio = $tmp_precio;   
                }
            }


            //validacion de datos de stock (si no hay datos es 0 por defecto y se controla que sea un numero entero positivo)
            if($tmp_stock == ""){
                $stock = 0; //si no se ha seleccionado nada, se coloca por defecto 0
            } elseif (is_numeric($tmp_stock) && $tmp_stock >= 0) { //controlo que sea un dato numerico mayor o igual a 0
                    $stock = (int)$tmp_stock; //si es correcto asigno el valor a la variable final
            } else {
                $err_stock = "El stock debe ser un número positivo.";
            }

            //validacion de datos de descripcion
            if($tmp_descripcion == ""){
                $err_descripcion = "La descripcion es obligatoria.";
            }else{
                //compruebo que el formato sea correcto.
                $patron = "/^.{1,255}$/";
                if(!preg_match($patron,$tmp_descripcion)){
                    $err_descripcion = "La descripcion no puede superar los 255 caracteres.";
                } else {
                    //si todo es correcto asigno el valor a la variable final.
                    $descripcion = $tmp_descripcion;
                }

            }
                
            
            //Si todos los datos son correctos, inserto los valroes en la base de datos
            if(isset($nombre) && isset($precio) && isset($categoria) && isset($stock) && isset($descripcion)){

                $numero = mt_rand(1, 9); // La primera cifra no puede ser 0
                for ($i = 1; $i < 13; $i++) {
                    $numero .= mt_rand(0, 9); // Añadir cifras del 0 al 9
                }

                $codigo_producto = $numero;

                $sql = "INSERT INTO productos (codigo_producto, nombre, precio, categoria, stock, imagen, descripcion) 
                VALUES ($codigo_producto,'$nombre', $precio, '$categoria', $stock, '$ubicacion_final', '$descripcion')";

                $_conexion -> query($sql);
            }
        }

        //Creacion de un array para almacenar las categorias que hay en la Base de datos para mostrarlas en el select
        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        $categorias = [];

        while($fila = $resultado -> fetch_assoc()) {
            array_push($categorias, $fila["categoria"]);
        }

 
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre">
                <?php if(isset($err_nombre)) echo"<h1>$err_nombre</h1>"?>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="text" name="precio">
                <?php if(isset($err_precio)) echo"<h1>$err_precio</h1>"?>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select class="form-select" name="categoria">
                    <option value="" selected disabled hidden>--- Elige la categoria ---</option>
                    <?php
                    foreach($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria ?>">
                            <?php echo $categoria ?>
                        </option>
                    <?php } ?>
                </select>
                <?php if(isset($err_categoria)) echo"<h1>$err_categoria</h1>"?>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" type="text" name="stock">
            </div>
            <div class="mb-3">
                <label class="form-label">imagen</label>
                <input class="form-control" type="file" name="imagen">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="4"></textarea>
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