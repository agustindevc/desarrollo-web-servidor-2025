<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  

        require('../util/conexion.php');
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tmp_usuario = $_POST["usuario"];
        $tmp_contrasena = $_POST["contrasena"];

        //validacion del campo usuario
        if($tmp_usuario == ""){
            $err_usuario = "El usuario es obligatorio";
        }else{
            //compruebo que el formato sea el correcto.
            $patron = '/^[a-zA-Z0-9]{3,15}$/';
            if(!preg_match($patron,$tmp_usuario)){
                $err_usuario = "El formato de usuario es incorrecto.";
            }else{
                //compruebo si el usuario existe o no
                $existe = "SELECT * FROM usuarios WHERE usuario = '$tmp_usuario'";
                $resultado = $_conexion -> query($existe);
                if($resultado -> num_rows > 0){
                    $err_usuario = "El usuario ya existe, debes elegir otro.";
                }else{
                    //si todo es correcto, asigno valor a la variable final
                    $usuario = $tmp_usuario;
                }
            }
        }
  
        //validacion del campo contraseña
        if($tmp_contrasena == ""){
            $err_contrasena = "La contraseña es obligatoria";
        }else{
            //compruebo que el formato sea el correcto.
            $patron = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).{8,15}$/";
            if(!preg_match($patron,$tmp_contrasena)){
                $err_contrasena = "Debes incluir una mayuscula, una minuscula, y un numero";
            }else{
                //si todo es correcto, asigno valor a la variable final.
                $contrasena = $tmp_contrasena;
            }
        }
    }
    
        
        //si los datos ingresados son validos, se envian a la base de datos.
        if(isset($usuario) && isset ($contrasena)){
            $contrasena_cifrada = password_hash($contrasena,PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios VALUES ('$usuario','$contrasena_cifrada')";
            $_conexion -> query($sql);

            header("location: iniciar_sesion.php"); //se redirige a "iniciar sesion"
            exit;
        }
    
    ?>

    <div class="container">
        <h1>Registro</h1>
        <form action="" method="post" enctype="multipart/form-data"> <!--Se agrega el enctype para que pueda leer imagenes?? -->
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
                <?php if(isset($err_usuario)) echo "<h1>$err_usuario</h1>"?>
            </div>
    <!--Campo para la contraseña-->
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="contrasena">
                <?php if(isset($err_contrasena)) echo "<h1>$err_contrasena</h1>"?>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Regitrarse">
                <a class="btn btn-secondary" href="iniciar_sesion.php">Iniciar sesión</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>