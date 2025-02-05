<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chiste aleatorio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        // Habilitar la visualización de errores en PHP
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        // URL de la API para obtener las categorías de chistes
        $apiUrlCategorias = "https://api.chucknorris.io/jokes/categories";
        
        // Inicializar cURL para hacer la petición a la API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrlCategorias); // Establecer la URL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Indicar que devuelva el resultado en lugar de imprimirlo
        $respuestaCategorias = curl_exec($curl); // Ejecutar la petición
        curl_close($curl); // Cerrar la conexión cURL

        // Decodificar la respuesta JSON en un array de PHP
        $categorias = json_decode($respuestaCategorias, true);

        // Verificar si el usuario ha seleccionado una categoría
        if (isset($_GET['categories'])) {
            $categoriaSeleccionada = $_GET['categories']; // Obtener la categoría seleccionada por el usuario
            
            // URL para obtener un chiste aleatorio de la categoría seleccionada
            $apiUrlRandom = "https://api.chucknorris.io/jokes/random?category=$categoriaSeleccionada";
            
            // Inicializar cURL para obtener el chiste
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrlRandom);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuestaRandom = curl_exec($curl);
            curl_close($curl);

            // Decodificar la respuesta JSON
            $datosRandom = json_decode($respuestaRandom, true);
            $chiste = $datosRandom['value']; // Extraer el texto del chiste
            $foto = $datosRandom['icon_url']; // Extraer la URL del icono
        }
    ?>
    
    <div class="container">
        <!-- Formulario para seleccionar una categoría de chistes -->
        <form method="get" class="col-4">
            <label for="categories" class="form-label">Categoría:</label>
            <select name="categories" id="categories" class="form-select">
                <?php
                    // Generar opciones del menú desplegable con las categorías obtenidas de la API
                    foreach($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria ?>"><?php echo $categoria ?></option>
                    <?php } ?>   
            </select><br>
            <input type="submit" value="Generar" class="btn btn-primary"><br><br>
        </form>

        <?php
        // Mostrar el chiste si se ha seleccionado una categoría
        if (isset($chiste)) { ?>
            <img src="<?php echo $foto ?>" alt="Chuck Norris"><br>
            <p><?php echo $chiste ?></p>
        <?php } ?>
    </div>
</body>
</html>