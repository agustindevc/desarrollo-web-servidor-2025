<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );
    ?> 
</head>
<body>
    <div class="container">
        <?php
        if(!isset($_GET["id"])){
            header("location: top_anime.php");
        }
            $id = $_GET["id"];
            $apiUrl = "https://api.jikan.moe/v4/anime/$id/full";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $datos = json_decode($respuesta, true);
            $anime = $datos["data"];
            //print_r($anime);
        ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Titulo</th>
                    <th>Imagen</th>
                    <th>Nota</th>
                    <th>Sinopsis</th>
                    <th>Género</th>
                    <th>Trailer</th>
                    <th>Relacionados</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <h1><?php echo $anime["title"] ?> </h1>
                    </td>
                    <td>
                        <img  width="100" src="<?php echo $anime["images"]["jpg"]["image_url"] ?>">
                    </td>
                    <td>
                        <p><?php echo $anime["score"] ?> </p>
                    </td>
                    <td>
                        <p><?php echo $anime["synopsis"] ?> </p>
                    </td>
                    <td>
                        <ul>
                            <?php foreach ($anime["genres"] as $genero) ?>
                                <li><?php echo ($genero["name"]); ?></li>
                        </ul>
                    </td>
                    <td>
                        <iframe src="<?php echo ($anime["trailer"]["embed_url"]); ?>"></iframe>
                    </td>
                    <td>
                        <ul>
                            <?php foreach($anime["relations"] as $relation){
                                foreach($relation["entry"] as $entry){
                                    if($entry["type"] == "anime"){ ?>
                                        <a href="anime.php?id=<?php echo $entry["mal_id"] ?>">
                                    <?php echo $anime["title"] ?>
                                </a>
                                    <?php }
                                }
                            } ?>
                        </ul>
                    </td>
                </tr>
            </tbody>
    </table>
    </div>
</body>
</html>
