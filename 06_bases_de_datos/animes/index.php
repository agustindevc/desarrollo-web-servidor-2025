<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index de Animes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('conexion.php');

        /*session_start();
        if(isset($_SESSION["usuario"])) {
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] . "</h2>";
        }else{
            header("location: usuario/iniciar_sesion.php");
            exit;
        }
        */
    ?>
</head>
<body>
    <div class="container">
        <a class="btn btn-warning" href="usuario/cerrar_sesion.php">Cerrar sesión</a>
        <h1>Tabla de animes</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"]== "POST"){
                //sentencia sql para borrar un anime en particular utilizando su id
                $id_anime = $_POST["id_anime"]; 
                echo "<h1>$id_anime</h1>";
                
                //1- (prepared statement)
                $sql = $_conexion -> prepare("DELETE FROM animes WHERE id_anime = ?");
                

                //2-enlazado (binding)
                $sql -> bind_param("i",
                $id_anime);

                //3- ejecucion
                $sql -> execute();
            }

            $sql = "SELECT * FROM animes";
            $resultado = $_conexion -> query($sql); /*La funcion query aplicada a la conexion 
                                                    ejecuta la sentencia SQL Hecha, en dicha conexion 
                                                    y la almacena en un objeto llamado en este caso $resuñtado*/
            
            //cierro la base de datos
            $_conexion -> close();
        ?>

        <a class= "btn btn-secondary" href="nuevo_anime.php">Crear Nuevo Anime</a><br><br>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Titulo</th>
                    <th>Estudio</th>
                    <th>Año</th>
                    <th>Numero de temporadas</th>
                    <th>Imagen</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()) { //trata el resultado como un array asociativo
                                                                //la variable $fila es un array bidimensional que guarda los
                                                                //resultados de la asociacion, miestras existan filas
                        echo "<tr>";
                        echo "<td>" . $fila["titulo"] . "</td>";
                        echo "<td>" . $fila["nombre_estudio"] . "</td>";
                        echo "<td>" . $fila["anno_estreno"] . "</td>";
                        echo "<td>" . $fila["num_temporadas"] . "</td>";
                        ?>
                        <td>
                            <img width ="100" height="200" src ="<?php echo $fila["imagen"] ?>"> <!--Muestro la imagen por pantalla-->
                        </td>
                        <td>
                            <a class="btn btn-primary"
                                href="ver_anime.php?id_anime=<?php echo $fila["id_anime"]?>">Editar</a> <!--Creamos el boton con el enlace en ese formayo, y le pasamos el iddelanime-->                   
                        </td>
                        <td>
                            <Form action="" method="post">
                                <input type="hidden" name="id_anime" value="<?php echo $fila["id_anime"] ?>"> <!--toma el ide_anime de la base de datos. lo hago para poder capturarlo mediante el formulario y traerlo de mla base de datos-->
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </Form>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </div>
</body>
</html>