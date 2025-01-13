<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php require '../util/conexion.php'; ?>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  

        //controlo que la sesion este iniciada
        session_start();
        if(isset($_SESSION["usuario"])){
            echo"<h2>Bienvenido " . $_SESSION["usuario"] . "</h2>";
        } else {
            header("location: usuario/iniciar_sesion.php");
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

        <h1>Nueva Categoría</h1>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_categoria = $_POST["categoria"];
            $tmp_descripcion = $_POST["descripcion"];
    
        //Validacion de datos de categoria.
        if($tmp_categoria == ""){
            $err_categoria = "debes ingresar una categoria.";
        }else{
            //controlo que el formato sea el correcto.
            $patron = "/^[A-Za-z\s]{2,30}$/";
            if(!preg_match($patron,$tmp_categoria)){
                $err_categoria = "La categoria solo puede tener letras o espacios en blanco, mino 2 caracteres y maximo 30.";
            }else{
                 //compruebo si la categoria ya existe o no
                 $existe = "SELECT * FROM categorias WHERE categoria = '$tmp_categoria'";
                 $resultado = $_conexion -> query($existe);
                 if($resultado -> num_rows > 0){
                     $err_categoria = "La categoria ya existe.";
                 }else{
                    //si todo el correcto, asigno el valor a la variable final
                    $categoria = $tmp_categoria;
                 }
               
            }
        }

        //Validacion de catos de descripcion.
        if($tmp_descripcion == ""){
            $err_descripcion = "La descripcion es obligatoria.";
        }else{
            //controlo que el formato sea el correcto.
            $patron = "/^.{0,255}$/";
            if(!preg_match($patron,$tmp_descripcion)){
                $err_descripcion = "La descripcion no puede tener mas de 255 caracteres.";
            }else{
                //si todo el correcto, asigno el valor a la variable final
                $descripcion = $tmp_descripcion;
            }

        }

    }
        //Si los nuevos datos son correctos, los inserto en la base de datos.
        if(isset($categoria) && isset($descripcion)){
            
            //1-Prepared Statement
            $sql = $_conexion -> prepare("INSERT INTO categorias (categoria, descripcion)
                VALUES (?,?)");

            //2-Binding
            $sql -> bind_param("ss", $categoria, $descripcion);

            //3-Ejecucion
            $sql -> execute();
        }
        ?>

        <form action="" method="post" enctype="multipart/form-data"> 
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <input class="form-control" type="text" name="categoria">
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