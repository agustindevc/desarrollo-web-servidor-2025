<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    
    ?>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Libros</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $tmp_titulo = $_POST["titulo"];
                $tmp_paginas = $_POST["paginas"];
                if(isset($_POST["genero"])) { /*DEBO COMPROBAR QUE SE HAfYA SELECCIONADO ALGO*/
                    $tmp_genero = $_POST["genero"];
                } else {
                    $tmp_genero = "";
                }

                if(isset($_POST["secuela"])) { 
                    $tmp_secuela = $_POST["secuela"];
                } else {
                    $tmp_secuela = "";
                }

                $tmp_fecha_publicacion = $_POST["fecha_publicacion"];
                $tmp_sinopsis = $_POST["sinopsis"];


                //validacion de datos del titulo
                if($tmp_titulo == ""){
                    $err_titulo = "El titulo es obligatorio.";
                } else {
                    $patron = "/^[0-9a-zA-ZáéíóúÁÉÍÓÚñÑüÜ.,;\s]{1,40}$/";
                    if(!preg_match($patron, $tmp_titulo)){
                        $err_titulo = "Formato de titulo incorrecto";
                    } else {
                        $titulo = $tmp_titulo;
                    }
                }
                

                //validacion de datos de paginas
                if($tmp_paginas == ""){
                    $err_paginas = "El numero de paginas es obligatorio.";
                } else {
                    $patron = "/^[0-9]{1,4}$/";
                    if(!preg_match($patron, $tmp_paginas)){
                        $err_paginas = "Formato de paginas es incorrecto";
                    }else {
                        $paginas = $tmp_paginas;
                    }
                }

                //Vlidacion de datos de genero
                if($tmp_genero == ""){
                    $err_genero = "Debes seleccionar una opcion de genero.";
                } else {
                    $genero = $tmp_genero;
                }

                if($tmp_secuela == ""){
                    $err_secuela = "Debes seleccionar una opcion.";
                } else {
                    $secuela = $tmp_secuela;
                }

                //validacion de datos de fecha de fundacion
                if($tmp_fecha_publicacion != ""){
                    list($anno_publicacion,$mes_publicacion,$dia_publicacion) =
                        explode('-',$tmp_fecha_publicacion);
                    if($anno_publicacion < 1800) {
                        $err_fecha_publicacion = "El año no puede ser anterior a 1800";
                    } else{ 
                        $anno_actual = date("Y");
                        $mes_actual = date("m");
                        $dia_actual = date("d");

                        if($anno_publicacion - $anno_actual < 3) {
                            $fecha_publicacion = $tmp_fecha_publicacion;
                        } elseif ($anno_publicacion - $anno_actual > 3) {
                            $err_fecha_publicacion = "La fecha debe ser anterior a 5 años";
                        } elseif ($anno_publicacion - $anno_actual == 3) {
                            if($mes_publicacion - $mes_actual < 0) {
                                $fecha_publicacion = $tmp_fecha_publicacion;
                            }elseif($mes_publicacion -$mes_actual > 0) {
                                $err_fecha_publicacion = "La fecha debe ser anterior a 5 años";
                            }elseif($mes_publicacion - $mes_actual == 0){
                                if($dia_publicacion - $dia_actual <= 0) {
                                    $fecha_publicacion = $tmp_fecha_publicacion;
                                }elseif($dia_publicacion - $dia_actual > 0){
                                    $err_fecha_publicacion = "La fecha debe ser anterior a dentro de 5 años";
                                }
                            }
                        }
                    }
                }

                //VALIDACION DE DATOS DE SINOPSIS
                if($tmp_sinopsis != ""){
                    $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{0,200}$/";
                    if(!preg_match($patron, $tmp_sinopsis)){
                        $err_sinopsis = "Formato de sinopsis incorrecto";
                    } else {
                        $sinopsis = $tmp_sinopsis;
                    }
                }
            }

        ?>
    <form class="col-10" action="" method="post">
        <div class="mb-3">
            <label class="form-label">Título</label>
            <input class="form-control" type="text" name="titulo">
            <?php if(isset($err_titulo)) echo "<span class='error'> $err_titulo</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Páginas</label>
            <input class="form-control" type="text" name="paginas">
            <?php if(isset($err_paginas)) echo "<span class='error'> $err_paginas</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Genero</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" value="fantasia">
                <label class="form-check-label">Fantasia</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" value="ciencia ficcion">
                <label class="form-check-label">Ciencia Ficcion</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" value="romance">
                <label class="form-check-label">Romance</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="genero" value="drama">
                <label class="form-check-label">Drama</label>
            </div>
            <?php if(isset($err_liga)) echo "<span class='error'>$err_liga</span>" ?>
        </div>
        <div class="mb-3">
            ¿Tiene secuela?
            <select name="secuela">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="si">Si</option>
                <option value="no">No</option>
            </select>
            <?php if(isset($err_secuela)) echo "<span class='error'> $err_secuela</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de publicacion</label>
            <input class="form-control" type="date" name="fecha_publicacion">
            <?php if(isset($err_fecha_publicacion)) echo "<span class='error'> $err_fecha_publicacion</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Sinópsis</label>
            <input class="form-control" type="text" name="sinopsis">
            <?php if(isset($err_sinopsis)) echo "<span class='error'> $err_sinopsis</span>"?>
        </div>

        <!--BOTON-->
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Enviar">
        </div>
        
    </form>
            <!--EN CASO DE DATOS CORRECTOS, MESTRO POR PANTALLA-->
    <?php
        if(isset($titulo) && isset($paginas) && isset($genero) && isset($secuela) && isset($fecha_publicacion)
        && isset($sinopsis)){ ?>
        <h1> <?php echo "Titulo:". $titulo ?> </h1>
        <h1> <?php echo "Paginas: ". $paginas ?> </h1>
        <h1> <?php echo "Genero: " . $genero ?> </h1>
        <h1> <?php echo "Secuela: " . $secuela ?> </h1>
        <h1> <?php echo "Fecha de Publicacion: " . $fecha_publicacion ?> </h1>
        <h1> <?php echo "Sinopsis: " . $sinopsis ?> </h1>

        <?php } ?>
    </div>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>