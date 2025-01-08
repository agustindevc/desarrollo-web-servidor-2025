<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
    ?>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_nombre = $_POST["nombre"];
            $tmp_fecha_fundacion = $_POST["fecha_fundacion"];
            $tmp_numero_jugadores = $_POST["numero_jugadores"];
            if(isset($_POST["titulo"])) { /*DEBO COMPROBAR QUE EN EL SELECT SE HAYA SELECCIONADO ALGO*/
                $tmp_titulo = $_POST["titulo"];
            } else {
                $tmp_titulo = "";
            }

            $tmp_inicial = $_POST["inicial"];

            if(isset($_POST["liga"])) { /*DEBO COMPROBAR QUE SE HAfYA SELECCIONADO ALGO*/
                $tmp_liga = $_POST["liga"];
            } else {
                $tmp_liga = "";
            }

            $tmp_ciudad = $_POST["ciudad"];

            //VALIDACION DE DATOS DEL NOMBRE
            if($tmp_nombre == ''){
                $err_nombre = "El nombre es obligatorio";
            } else {
                $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜç\s.]{3,20}$/"; /*....................CONTROLAR SI EL PATRON ES CORRECTO */
                if(!preg_match($patron, $tmp_nombre)) {
                    $err_nombre = "El formato de nombre no es correcto";
                } else {
                    $nombre = $tmp_nombre;
                }
            }

            //VALIDACION DE SELECCION DE OPCION EN TITULO
            if($tmp_titulo == ""){
                $err_titulo = "Debes seleccionar una opcion.";
            } else {
                $titulo = $tmp_titulo;
            }

            //validacion de datos de inicial
            if($tmp_inicial ==""){
                $err_inicial = "Debes ingresar una inicial";
            } else {
                $patron = "/^[a-zA-Z]{3}+$/";
                if(!preg_match($patron,$tmp_inicial)){
                    $err_inicial = "La inicial debe contener 3 letras.";
                } else {
                    $inicial = $tmp_inicial;
                }
            }

            //Validacion de ingreso de datos en de liga
            if($tmp_liga == ""){
                $err_liga = "Debes seleccionar una opcion de liga.";
            } else {
                $liga = $tmp_liga;
            }

            //

            //VALIDACION DE DATOS DE FECHA DE FUNDACION

            //copmprobar que el campo de la fecha no este vacio
            if($tmp_fecha_fundacion == ''){
                $err_fecha_fundacion = "Debes ingresar la fecha de fundacion";
            } else {
                //comprobar que el formato sea correcto
                //se debe colocar el aptron con el año primero, luiego el mes y luego el dia
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if(!preg_match($patron, $tmp_fecha_fundacion)){
                    $err_fecha_fundacion = "formato de fecha incorrecto";
                } else {
                    list($anno,$mes,$dia) = explode('-',$tmp_fecha_fundacion);
                    if($anno < 1889){
                        $err_fecha_fundacion = "La fecha de fundacion no puede ser anterior al 18/12/1889";
                    } elseif($anno == 1889) {
                        if($mes < 12){
                            $err_fecha_fundacion = "La fecha de fundacion no puede ser anterior al 18/12/1889";
                        } elseif ($mes == 12){
                            if($dia < 18){
                                $err_fecha_fundacion = "La fecha de fundacion no puede ser anterior al 18/12/1889";
                            }
                        }
                    }

                    //comprobar que la fecha ingresada no sea posterior a la recha actual
                    $fecha_actual = date("Y-m-d"); //obtengo la fecha actual
                    list($anno_actual,$mes_actual,$dia_actual) = explode("-",$fecha_actual);
                    if($anno > $anno_actual){
                        $err_fecha_fundacion = "la fecha de fundacion no puede ser mayor a la fecha actual.";
                    }elseif($anno == $anno_actual){
                        if($mes > $mes_actual){
                            $err_fecha_fundacion = "la fecha de fundacion no puede ser mayor a la fecha actual.";
                        } elseif($mes == $mes_actual){
                            if($dia > $dia_actual){
                                $err_fecha_fundacion = "la fecha de fundacion no puede ser mayor a la fecha actual.";
                            }
                        }   
                    } else {
                        $fecha_fundacion = $tmp_fecha_fundacion;
                    }  
                }
            }

            //validacion de numero de jugadores (entre 19 y 32)
            if($tmp_numero_jugadores < 19){
                $err_numero_jugadores = "El numero de jugadores no puede ser menor a 19.";
            } elseif ($tmp_numero_jugadores > 23){
                $err_numero_jugadores = "El numero de jugadores no puede ser mayor a 23.";
            } else {
                $numero_jugadores = $tmp_numero_jugadores;
            }

            //validacion de ciudad
            if($tmp_ciudad == ""){
                $err_ciudad = "El campo de ciudad es obligatorio.";
            } else {
                $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚç\s]+$/"; //cuando h¿no hay rango se coloca el + luego del corchete ].
                if(!preg_match($patron,$tmp_ciudad)){
                    $err_ciudad = "El formato de la ciudad es incorrecto.";
                }
                else{
                    $ciudad = $tmp_ciudad;
                }
            }
        }
    ?>

    <div class="container">
        <h1>Formulario de Equipos</h1>
        <form class="col-4" action="" method="post">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre">
                <?php if(isset($err_nombre)) echo "<span class='error'> $err_nombre</span>"?>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de fundacion</label>
                <input class="form-control" type="date" name="fecha_fundacion">
                <?php if(isset($err_fecha_fundacion)) echo "<span class='error'> $err_fecha_fundacion</span>"?>
            </div>
            <div class="mb-3">
                <label class="form-label">Número de jugadores</label>
                <input class="form-control" type="text" name="numero_jugadores">
                <?php if(isset($err_numero_jugadores)) echo "<span class='error'> $err_numero_jugadores</span>"?>
            </div>
            <div class="mb-3">
                ¿Ha ganado un titulo de liga?
                <select name="titulo">
                    <option value="" selected disabled hidden>Selecciona una opción</option>
                    <option value="si">Si</option>
                    <option value="no">No</option>
                </select>
                <?php if(isset($err_titulo)) echo "<span class='error'> $err_titulo</span>"?>
            </div>
            <div class="mb-3">
                <label class="form-label">Inicial</label>
                <input class="form-control" type="text" name="inicial">
                <?php if(isset($err_inicial)) echo "<span class='error'> $err_inicial</span>"?>
            </div>
            <div class="mb-3">
                <label class="form-label">Liga</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="liga" value="Liga EA Sports">
                    <label class="form-check-label">Liga EA Sports</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="liga" value="Liga Hypermotion">
                    <label class="form-check-label">Liga Hypermotion</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="liga" value="Liga Primera RFEF">
                    <label class="form-check-label">Liga Primera RFEF</label>
                </div>
                <?php if(isset($err_liga)) echo "<span class='error'>$err_liga</span>" ?>
            </div>
            <div>
                <label class="form-label">Ciudad</label>
                <input class="form-control" type="text" name="ciudad">
                <?php if(isset($err_ciudad)) echo "<span class='error'> $err_ciudad</span>"?>
            </div>
            <br>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Enviar">
            </div>
        </div>
    </form>
    <!--SI TODO ES CORRECTO, SE CREA LA ESTRUCTURA PARA ENVIAR LOS DATOS A LA BASE DE DATOS-->
    
    <?php
        if(isset($nombre) && isset($fecha_fundacion) && isset($numero_jugadores) && isset($titulo) && isset($inicial)
        && isset($liga) && isset($ciudad)){ ?>
        <h1> <?php echo "Nombre del equipo:". $nombre ?> </h1>
        <h1> <?php echo "fecha de fundacion: ". $fecha_fundacion ?> </h1>
        <h1> <?php echo "Numero de jugadores: " . $numero_jugadores ?> </h1>
        <h1> <?php echo "Ha ganado un titulo de liga: " . $titulo ?> </h1>
        <h1> <?php echo "Inicial: " . $inicial ?> </h1>
        <h1> <?php echo "Liga: " . $liga ?> </h1>
        <h1> <?php echo "Ciudad: " . $ciudad ?> </h1>


        <?php } ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>