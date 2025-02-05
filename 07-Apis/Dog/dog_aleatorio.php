<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perros random</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        // Habilitar la visualización de errores en PHP
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        // URL de la API para obtener una imagen aleatoria de un perro
        $apiUrl = "https://dog.ceo/api/breeds/image/random";
        
        // Inicializar cURL para hacer la petición a la API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl); // Establecer la URL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Indicar que devuelva el resultado en lugar de imprimirlo
        $respuesta = curl_exec($curl); // Ejecutar la petición
        curl_close($curl); // Cerrar la conexión cURL

        // Decodificar la respuesta JSON
        $datos = json_decode($respuesta, true);
        $random_image = $datos["message"]; // Extraer la URL de la imagen del perro
    ?>
    
    <div class="container">
        <!-- Botón para recargar la página y generar una nueva imagen -->
        <br><a href="./dog_aleatorio.php" class="btn btn-info">Generar</a><br><br>
        
        <!-- Mostrar la imagen aleatoria del perro -->
        <img width="400px" src="<?php echo $random_image ?>" alt="Imagen aleatoria de un perro"><br><br>
    </div>  
</body>
</html>
