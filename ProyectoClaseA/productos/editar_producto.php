<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar productos</title>
    <link rel="stylesheet" href="estilos.css">
    <?php require ('../util/conexion.php'); ?>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  

        /*//controlo que la sesion este iniciada
        session_start();
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenido " . $_SESSION["usuario"] . "</h2>";
        } else {
            header("location: usuario/iniciar_sesion.php");
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

        <h1>Editar Producto</h1>

        <?php
            $codigo_producto = $_GET["codigo_producto"]; //traigo el id del producto y lo almaceno en la variable
            $sql = "SELECT * FROM productos WHERE codigo_producto = $codigo_producto"; //cogemos la informacion del producto que contenga esa id
            $resultado = $_conexion -> query($sql); //almaceno la informacion en la variable resultado.
    
       
        while($fila = $resultado -> fetch_assoc()){ //estructura para separar la informacion en variables
            $nombre = $fila["nombre"];
            $precio = $fila["precio"];
            $categoria = $fila["categoria"];
            $stock = $fila["stock"];
            $descripcion = $fila["descripcion"];
        }

        //CAPTURAMOS LOS NUEVOS DATOS
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_nombre = $_POST["nombre"];
            $tmp_precio = $_POST["precio"];
            $tmp_categoria = $_POST["categoria"];
            $tmp_stock = $_POST["stock"];
            $tmp_descripcion = $_POST["descripcion"];

            //Validacion de datos de nombre
            if($tmp_nombre == ""){
                $err_nombre = "El nombre del producto es obligatorio.";
            } else {
                //compruebo que el formato sea correcto
                $patron = "/^[A-Za-z0-9 ]{2,50}$/";
                if(!preg_match($patron,$tmp_nombre)){
                    $err_nombre = "El nombre debe tener minimo 2 caracteres y maximo 50. SOlo puede tener letras, numeros y espacios en blanco."; 
                }else{
                    //si todo es correcto asigno el valor a la variable final.
                    $nombre = $tmp_nombre;
                }
            }

            //validacion de datos de precio
            if($tmp_categoria == ""){
                $err_precio = "El precio del producto es obligatorio.";
            } else {
                //compruebo que el formato sea correcto.
                $patron = "/^(\d{1,6}(\.\d{1,2})?)$/";
                if(!preg_match($patron, $tmp_precio)){
                    $err_precio = "El precio debe ser minimo 0 y maximo 999999,99 y tiene que ser un numero.";
                }
                //si todo es correcto asigno el valor a la variable final.
                $precio = $tmp_precio;
            }

            //Validacion de datos de categoria
            if($tmp_categoria == ""){
                $err_categoria = "Debes seleccionar una categoria.";
            } else {
                $categoria = $tmp_categoria;
            }


            //validacion de datos de stock (si no hay datos es 0 por defecto y se controla que sea un numero entero positivo)
            if($tmp_stock == ""){
                //si no se ha seleccionado nada, se coloca por defecto 0
                $stock = 0;
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

            //MODIFICAMOS EL PRODUCTO EN LA BASE DE DATOS CON LOS NUEVOS CAMPOS
            if(isset($nombre) && isset($precio) && isset($categoria) && isset($stock) && isset($descripcion)){
            $sql = "UPDATE productos SET
                nombre = '$nombre',
                precio = '$precio',
                categoria = '$categoria',
                stock = '$stock',
                descripcion = '$descripcion'
                WHERE codigo_producto = '$codigo_producto'
                ";

                $_conexion -> query($sql);
            }
        }

        //Creacion de un array para almacenar las categorias que hay en la Base de datos, para mostrarlas en el select.
        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        $categorias = [];

        while($fila = $resultado -> fetch_assoc()) {
            array_push($categorias, $fila["categoria"]);
        }
        
        ?>

        <form action="" method="post" enctype="multipart/form-data"> 
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $nombre ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="text" name="precio" value="<?php echo $precio ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select class="form-select" name="categoria">
                    <option value="<?php echo $categoria ?>" selected hidden> <?php echo $categoria ?> </option>
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
                <input class="form-control" type="text" name="stock" value="<?php echo $stock ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="4"></textarea>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Guardar cambios">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </form>
    </div>
</body>
</html>