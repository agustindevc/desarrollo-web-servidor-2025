<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        // Habilita la visualización de errores para depuración
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        $apiUrl = "https://pokeapi.co/api/v2/pokemon";

        // Configurar la conexión a la API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        // Decodifica la respuesta JSON en un array asociativo
        $datos = json_decode($respuesta, true);
        // Extrae la lista de pokemons y la información de paginación
        $pokemons = $datos["results"];

        if (isset($_GET["id"])) {

            $id = $_GET["id"];

            $apiUrlImage = "https://pokeapi.co/api/v2/pokemon/$id/sprites/front_default";
        
        }
    ?>

        <?php
        
            echo "<ul>";
            $contador = 0;
                foreach($pokemons as $pokemon){
                    if($contador <= 4){?>
                        <li> <?php echo ucfirst($pokemon["name"]); ?> 
                        <img src="<?php  $apiUrlImage?>">
                        </li>
                        <?php
                        $contador++;
                    }
            }
            echo "</ul>";
        ?>
        
            
    <form></form>
</body>
</html>