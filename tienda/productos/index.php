<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');

        //Controlo que la sesion este iniciada.
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

    <!--Botones de la pagina-->
        <a class="btn btn-warning" href="../usuario/cerrar_sesion.php">Cerrar sesión</a>
        <a class="btn btn-warning" href="../util/index.php">volver</a>
        <a class= "btn btn-secondary" href="nuevo_producto.php">Nuevo Producto</a>
        <h1>Tabla de productos</h1>

        <?php
            if($_SERVER["REQUEST_METHOD"]== "POST"){
                //sentencia sql para borrar un producto en particular utilizando su id.
                $id_producto = $_POST["id_producto"]; 
                
                $sql = "DELETE FROM productos WHERE id_producto = $id_producto";
                $_conexion ->query($sql); 
            }
            //Obtengo los datos de los productos actuales de la base de datos para poder mostrarlos.
            $sql = "SELECT * FROM productos";
            $resultado = $_conexion -> query($sql); 
        ?>
        
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Imagen</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()) { 
                        echo "<tr>";
                        echo "<td>" . $fila["nombre"] . "</td>";
                        echo "<td>" . $fila["precio"] . "</td>";
                        echo "<td>" . $fila["categoria"] . "</td>";
                        echo "<td>" . $fila["stock"] . "</td>";
                        ?>
                        <td>
                            <img width ="100" height="200" src ="<?php echo $fila["imagen"] ?>"> <!--Muestro la imagen en la tabla-->
                        </td>
                        <?php
                        echo "<td>" . $fila["descripcion"] . "</td>";
                        ?>
                        <td>
                            <a class="btn btn-primary"
                                href="editar_producto.php?id_producto=<?php echo $fila["id_producto"]?>">Editar Producto</a> <!--Creamos el boton con el enlace en ese formato, y le pasamos el id del producto a editar-->                   
                        </td>
                        <td>
                            <Form action="" method="post">
                                <input type="hidden" name="id_producto" value="<?php echo $fila["id_producto"] ?>"> <!--toma el id_producto de la base de datos-->
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