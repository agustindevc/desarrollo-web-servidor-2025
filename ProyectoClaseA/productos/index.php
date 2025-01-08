<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index de Productos</title>
    <link rel="stylesheet" href="estilos.css">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');

        //Controlo que la sesion este iniciada.
        /*session_start();
        if(isset($_SESSION["usuario"])) {
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] . "</h2>";
        }else{
            header("location: usuario/iniciar_sesion.php");
            exit;
        }*/
    ?>
</head>
<body>
        <nav>
            <!--Botones de la pagina-->
            
            <a class="btn_nav" href="../index.php">Menú principal</a>
            <a class= "btn_nav" href="nuevo_producto.php">Nuevo Producto</a>
            <a class= "btn_nav" href="../categorias/index.php">Categorías</a>
            <a class="btn_close_session" href="../usuario/cerrar_sesion.php">Cerrar sesión</a>
        </nav>

        <div class="container">

        <h1>Tabla de productos</h1>

        <?php
            if($_SERVER["REQUEST_METHOD"]== "POST"){
                //sentencia sql para borrar un producto en particular utilizando su id.
                $codigo_producto = $_POST["codigo_producto"]; 
                
                $sql = "DELETE FROM productos WHERE codigo_producto = $codigo_producto";
                $_conexion ->query($sql); 
            }
            //Obtengo los datos de los productos actuales de la base de datos para poder mostrarlos.
            $sql = "SELECT * FROM productos";
            $resultado = $_conexion -> query($sql); 
        ?>
        
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th>Código del producto</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Imágen</th>
                    <th>Descripción</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()) { 
                        echo "<tr>";
                        echo "<td>" . $fila["codigo_producto"] . "</td>";
                        echo "<td>" . $fila["nombre"] . "</td>";
                        echo "<td>" . $fila["precio"] . "</td>";
                        echo "<td>" . $fila["categoria"] . "</td>";
                        echo "<td>" . $fila["stock"] . "</td>";
                        ?>
                        <td>
                            <img width ="100" height="100" src ="<?php echo $fila["imagen"] ?>"> <!--Muestro la imagen en la tabla-->
                        </td>
                        <?php
                        echo "<td>" . $fila["descripcion"] . "</td>";
                        ?>
                        <td>
                            <a class="btn_edit"
                                href="editar_producto.php?codigo_producto=<?php echo $fila["codigo_producto"]?>">Editar</a> <!--Creamos el boton con el enlace en ese formato, y le pasamos el id del producto a editar-->                   
                            <Form action="" method="post">
                                <input type="hidden" name="codigo_producto" value="<?php echo $fila["codigo_producto"] ?>"> <!--toma el codigo de la base de datos-->
                                <input class="btn_delete" type="submit" value="Eliminar">
                            </Form>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        </div>
</body>
</html>