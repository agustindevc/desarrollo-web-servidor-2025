<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  

        require('../util/conexion.php');

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

        <h1>Cambiar contraseña</h1>

        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];
            $nueva_contrasena = $_POST["nueva_contrasena"];

            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'"; //si el usuario existe devuelve una fila con el suario y la contraseña, si no existe devuelve 0 filas
            $resultado = $_conexion -> query($sql);
       

            if($resultado -> num_rows == 0) {
                echo "<h2>El usuario $usuario no existe</h2>";
            } else {
                $datos_usuario = $resultado -> fetch_assoc();
            
                //si el usuario ingresado existe, se permite el cambio
                $cambio_permitido = password_verify($contrasena,$datos_usuario["contrasena"]);
                //var_dum($acceso_concedido);
                if($cambio_permitido) {

                    //cifrado de la nueva contraseña
                    $nueva_contrasena_cifrada = password_hash($nueva_contrasena,PASSWORD_DEFAULT);

                    //actualizacion de contraseña en la base de datos
                    $sql = "UPDATE usuarios SET contrasena = '$nueva_contrasena_cifrada' WHERE usuario = '$usuario'";
                    $_conexion -> query($sql);

                    header("location: ../util/index.php");
                    exit;
                } else {
                    echo "<h2>La contraseña es incorrecta</h2>";
                }

            }

        }
        ?>  
        <form action="" method="post" enctype="multipart/form-data"> <!--Se agrega el enctype para que pueda leer imagenes?? -->
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña Actual</label>
                <input class="form-control" type="password" name="contrasena">
            </div>
            <div class="mb-3">
                <label class="form-label">Nueva contraseña</label>
                <input class="form-control" type="password" name="nueva_contrasena">
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Actualizar contraseña">
            </div>
            <div class="mb-3">
                <a class="btn btn-secondary" href="../util/index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>