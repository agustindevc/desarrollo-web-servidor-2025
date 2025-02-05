<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perro al azar | Raza</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        // Habilitar la visualización de errores en PHP
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        // URL de la API para obtener la lista de razas de perros
        $apiUrl = "https://dog.ceo/api/breeds/list/all";
        
        // Inicializar cURL para hacer la petición a la API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        // Decodificar la respuesta JSON
        $datos = json_decode($respuesta, true);
        $razas = $datos["message"]; // Extraer la lista de razas

        // Verificar si el usuario ha seleccionado una raza
        if (isset($_GET['breed'])) {
            $razaSeleccionada = $_GET['breed']; // Obtener la raza seleccionada por el usuario
            
            // URL para obtener una imagen aleatoria de la raza seleccionada
            $apiUrlImage = "https://dog.ceo/api/breed/$razaSeleccionada/images/random";
            
            // Inicializar cURL para obtener la imagen
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrlImage);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuestaImage = curl_exec($curl);
            curl_close($curl);

            // Decodificar la respuesta JSON
            $datosImage = json_decode($respuestaImage, true);
            $image = $datosImage['message']; // Extraer la URL de la imagen
        }
    ?>
    
    <div class="container">
        <!-- Formulario para seleccionar una raza de perro -->
        <form method="get" class="col-4">
            <label for="breed" class="form-label">Raza:</label>
            <select name="breed" id="breed" class="form-select">
                <?php
                    // Recorrer el array de razas obtenidas de la API
                    foreach($razas as $raza => $subRazas) { //el valor de subrazas se asigna automaticamente ya que raza es un array de clave-valor (en caso de que haya subrazas
                        )
                        // Verificar si la raza no tiene subrazas
                        if (empty($subRazas)) { ?>
                            <option value="<?php echo $raza ?>">
                                <?php echo $raza ?>
                            </option>
                        <?php } else {
                            // Si la raza tiene subrazas, recorrer cada una de ellas
                            foreach($subRazas as $subRaza) {
                                // Formar el nombre legible de la subraza (ejemplo: bulldog francés)
                                $mostrar_subRaza = $raza . " " . $subRaza;
                                // Formar la clave correcta para la API (ejemplo: bulldog/french)
                                $api_subRaza = $raza . "/" . $subRaza; ?>
                                <option value="<?php echo $api_subRaza ?>">
                                    <?= $mostrar_subRaza ?>
                                </option>
                        <?php }
                        }   
                    }   
                ?>
            </select><br>
            <input type="submit" value="Generar" class="btn btn-primary"><br><br>
        </form>

        <?php
        // Mostrar la imagen si se ha seleccionado una raza
        if (isset($image)) { ?>
            <img src="<?= $image ?>" class="img-fluid" alt="Imagen de la raza seleccionada">
        <?php } ?>
    </div>
</body>
</html>
