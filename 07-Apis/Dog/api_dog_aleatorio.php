<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $apiUrl = "https://dog.ceo/api/breed/affenpinscher/images/random";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $dogs = $datos["message"];
        

        ?>

        <div class="mb-3">
                <label class="form-label">Raza</label>
                <select class="form-select" name="raza">
                    <option value="" selected disabled hidden>--- Elige la raza ---</option>
                    <?php
                    foreach($dogs as $dog) { ?>
                        <option value="<?php echo $dog["message"] ?>">
                            <?php echo $dog ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        <img src="<?php echo $dogs ?>" alt="perroImagen">
    
</body>
</html>