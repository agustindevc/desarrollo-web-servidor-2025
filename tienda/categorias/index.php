<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index de categorias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');

        //Compruebo que se haya iniciado sesion
        session_start();
        if(isset($_SESSION["usuario"])) {
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] . "</h2>";
        }else{
            header("location: usuario/iniciar_sesion.php");
            exit;
        }
    ?>
</head>
<body>
    <div class="container">

        <!--botones de la pagina-->
        <a class="btn btn-warning" href="../usuario/cerrar_sesion.php">Cerrar sesión</a>
        <a class="btn btn-warning" href="../util/index.php">volver</a>
        <a class= "btn btn-secondary" href="nueva_categoria.php">Nueva Categoria</a><br><br>
        <h1>Tabla de categorias</h1>
        
        <?php
            if($_SERVER["REQUEST_METHOD"]== "POST"){
                //sentencia sql para borrar una categoria en particular utilizando su id.
                $categoria = $_POST["categoria"]; 
                
                $sql = "DELETE FROM categorias WHERE categoria = '$categoria'";
                if ($_conexion->query($sql)) {
                    echo "<p class='text-success'>Categoría eliminada correctamente.</p>";
                } else {
                    echo "<p class='text-danger'>Error al eliminar la categoría.</p>";
                }
            }

            //Obtengo los datos de las categorias actuales de la base de datos para poder mostrarlos
            $sql = "SELECT * FROM categorias";
            $resultado = $_conexion -> query($sql);

        ?>
        
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Categoria</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila["categoria"] . "</td>";
                        echo "<td>" . $fila["descripcion"] . "</td>";
                        ?>
                        <td>
                            <a class="btn btn-primary"
                                href="editar_categoria.php?categoria=<?php echo $fila["categoria"]?>">Editar categoria</a> <!--Creamos el boton con el enlace en ese formato, y le pasamos el id de la categoria a editar-->                   
                        </td>
                        <td>
                            <Form action="" method="post">
                                <input type="hidden" name="categoria" value="<?php echo $fila["categoria"] ?>"> <!--toma el categoria de la base de datos-->
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