<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require ('../util/conexion.php'); ?>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  

        //controlo que la sesion este iniciada
        session_start(); //Recuperar la sesion
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenido " . $_SESSION["usuario"] . "</h2>";
        } else {
            header("Location: ../usuario/iniciar_sesion.php");
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
        <h1>Editar categoria</h1>
        <?php
        $categoria = $_GET["categoria"]; //traigo el id de la categoria que estoy editando y lo almaceno en la variable.

        //1-Prepares statement
        $sql = $_conexion -> prepare("SELECT * FROM categorias WHERE categoria = ?"); //cogemos la informacion de la categoria que contenga esa id.
        
        //2-binding
        $sql -> bind_param("s",$categoria);

        //03-ejecucion
        $sql -> execute();

        //4-retrieve        
        $resultado = $sql -> get_result(); //almaceno la informacion en la variable resultado.
  
       
        while($fila = $resultado -> fetch_assoc()){ //estructura para separar la informacion en variables.
            $categoria = $fila["categoria"];
            $descripcion = $fila["descripcion"];
        }

        //CAPTURAMOS LOS NUEVOS DATOS
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_categoria = $_POST["categoria"];
            $tmp_descripcion = $_POST["descripcion"];

        

        //Validacion de catos de descripcion
        if($tmp_descripcion == ""){
            $err_descripcion = "La descripcion es obligatoria.";
        }else{
            //compruebo que el formato sea correcto
            $patron = "/^.{0,255}$/";
            if(!preg_match($patron,$tmp_descripcion)){
                $err_descripcion = "La descripcion no puede tener mas de 255 caracteres.";
            }else{
                //si todo es correcto asigno el valor a la variable final.
                $descripcion = $tmp_descripcion;
            }

        }


        //Modificacion de la categoria en la base de datos
        if(isset($categoria) && isset($descripcion)){

            //1-prepared statement
            $sql = $_conexion -> prepare("UPDATE categorias SET
                descripcion = ?
                WHERE categoria = ?
                ");

            //2-binding
            $sql -> bind_param("ss", $descripcion, $categoria);

            //3-ejecucion
            $sql -> execute();
        }
    }

        ?>

        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <input class="form-control" type="text" name="categoria" value="<?php echo $categoria ?>" disabled>
                <input class="form-control" type="hidden" name="categoria" value="<?php echo $categoria ?>">
                <?php if(isset($err_categoria)) echo"<h1>$err_categoria</h1>"?>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="4"></textarea>
                <?php if(isset($err_descripcion)) echo"<h1>$err_descripcion</h1>"?>
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