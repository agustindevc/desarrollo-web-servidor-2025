<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="../estilo.css">
    
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
    <div class="container">

        <h1 class="container__title">Iniciar sesión</h1>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario = $_POST["usuario"];
            $contrasena = $_POST["contrasena"];

            $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'"; //si el usuario existe devuelve una fila con el suario y la contraseña, si noe xiste devuelve 0 filas
            $resultado = $_conexion -> query($sql);
       

            if($resultado -> num_rows == 0) {
                echo "<h2>El usuario $usuario no existe</h2>";
            } else {
                $datos_usuario = $resultado -> fetch_assoc();
            
                //si los datos coinciden, se concede el accedo
                $acceso_concedido = password_verify($contrasena,$datos_usuario["contrasena"]);
                if($acceso_concedido) {
                    session_start();
                    $_SESSION["usuario"] = $usuario;
                    header("location: ../util/index.php"); //al iniciar sesion, manda al index.php
                    exit;
                } else {
                    echo "<h2>La contraseña es incorrecta</h2>";
                }

            }

        }
        ?>  
        <form class="form" action="" method="post">
            <div class="form__division">
                <label class="form-label">Usuario:</label>
                <input class="form-control" type="text" name="usuario">
            </div>
            <br>
            <div class="form__division">
                <label class="form-label">Contraseña:</label>
                <input class="form-control" type="password" name="contrasena">
            </div>
            <br>
            <div class="form__division">
                <input class="btn" type="submit" value="Iniciar Sesion">
            </div>
            <br>
            <div class="form__division">
                <a class="btn_registro_revendedor" href="registro_revendedor.php">Registrarse como revendedor</a>
            </div>
        </form>
    </div>
    <footer>
        <p>Desarrollado por Agustín Diaz - Todos los derechos reservados - &reg; Clase A Argentina.</p>
    </footer>
</body>
</html>