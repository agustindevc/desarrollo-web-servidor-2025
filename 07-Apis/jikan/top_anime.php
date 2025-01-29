<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Anime</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <?php
        if(isset($_GET["type"])) {
            $tipo = $_GET["type"];
        } else {
            $tipo = "";
        }

            $apiUrl = "https://api.jikan.moe/v4/top/anime";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $datos = json_decode($respuesta, true);
            $animes = $datos["data"];
            //print_r($animes);
        ?>

        <h1>Elige tipo:</h1>
            <label for="serie">Serie</label>
            <input type="radio" name="type" value="tv" id="tv"><br>
            <label for="pelicula">Pélicula</label>
            <input type="radio" name="type" value="movie" id="pelicula"><br>
            <label for="todos">Todos</label>
            <input type="radio" name="type" value="" id="todos">

            <label>
            <input type="radio" name="type" value="" <?php echo empty($type) ? 'checked' : ''; ?>> Todos
        </label>
            <br>
            <br>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Posición</th>
                    <th>Título</th>
                    <th>Nota</th>
                    <th>Imágen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($animes as $anime) {
                    if ($tipo === 'todos' || $anime['type'] === ucfirst($tipo)) { ?>
                    <tr>
                        <td> <?php echo $anime["rank"] ?> </td>
                        <td>
                            <a href="anime.php?id=<?php echo $anime["mal_id"] ?>">
                                <?php echo $anime["title"] ?>
                            </a>
                        </td>
                        <td> <?php echo $anime["score"] ?> </td>
                        <td>
                            <img width="100px" src="<?php echo $anime["images"]["jpg"]["image_url"]?>">
                        </td>
                    
                        <?php } 
                    } ?>
            </tbody>
        </table>
    </div>
</body>
</html>