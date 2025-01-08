<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    

        require('conexion.php');
    ?>
    
</head>
<body>
    <div class="container">
        <h1>Tabla de consolas</h1>
        <?php
            $sql = "SELECT * FROM consolas";
            $resultado = $_conexion -> query($sql); /*La funcion query aplicada a la conexion 
                                                    ejecuta la sentencia SQL Hecha, en dicha conexion 
                                                    y la almacena en un objeto llamado en este caso $resuñtado*/

        ?>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Fabricante</th>
                    <th>Generacion</th>
                    <th>Unidades Vendidas</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($fila = $resultado -> fetch_assoc()) { //trata el resultado como un array asociativo
                                                                //la variable $fila es un array bidimensional que guarda los
                                                                //resultados de la asociacion, miestras existan filas
                        echo "<tr>";
                        echo "<td>" . $fila["nombre"] . "</td>";
                        echo "<td>" . $fila["fabricante"] . "</td>";
                        echo "<td>" . $fila["generacion"] . "</td>";
                        if($fila["unidades_vendidas"] == null){
                            echo "<td>No hay unidades vendidas</td>";
                        } else {
                        echo "<td>" . $fila["unidades_vendidas"] . "</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </div>
</body>
</html>