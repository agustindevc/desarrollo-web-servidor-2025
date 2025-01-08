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
    ?>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
    <!--Content Here-->
        <h1>Formulario usuario</h1>

    <?php

    //VARIABLES
    $mayor_edad = 18;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $tmp_usuario = $_POST["usuario"];
        $tmp_nombre = $_POST["nombre"];
        $tmp_apellido = $_POST["apellido"];
        $tmp_dni = $_POST["dni"];
        $tmp_correo = $_POST["correo"];
        $tmp_fecha_nacimiento = $_POST["fecha_nacimiento"];
        $tmp_fecha_primer_dni = $_POST["fecha_primer_dni"];
    

        if($tmp_dni == ''){
            $err_dni = "El DNI es obligatorio";
        } else {
            $tmp_dni = strtoupper($tmp_dni); //PASO A MAYUSCULAS CON ESTA FORMULA
            $patron = "/^[0-9]{8}[A-Z]$/";
            if(!preg_match($patron,$tmp_dni)){
                $err_dni = "El dni debe tener 8 digitos y una letra";
            } else {
                $numero_dni = substr($tmp_dni,0,8); //divido el string del dni desde la posicion 0 a la 8
                $letra_dni = substr($tmp_dni,8,1); //tomo la letra del dni

                //MATCH PARA OBTENER LA LETRA CORRECTA

                $resto_dni = $numero_dni % 23;

                $letra_correcta = match($resto_dni) {
                    0 => "T",
                    1 => "R",
                    2 => "W",
                    3 => "A",
                    4 => "G",
                    5 => "M",
                    6 => "Y",
                    7 => "F",
                    8 => "P",
                    9 => "D",
                    10 => "X",
                    11 => "B",
                    12 => "N",
                    13 => "J",
                    14 => "Z",
                    15 => "S",
                    16 => "Q",
                    17 => "V",
                    18 => "H",
                    19 => "L",
                    20 => "C",
                    21 => "K",
                    22 => "E"
                };

                if($letra_dni != $letra_correcta){
                    $err_dni = "La letra del DNI no es correcta";
                } else {
                    $dni = $tmp_dni;
                }

            }
        }

        //VALIDACIOND E DATOS DEL CORREO
        if($tmp_correo == ''){
            $err_correo = "El correo electrónico es obligatorio";
        } else {
            //comprobacion de correo
            $patron = "/^[a-zA-Z0-9_\-.+]+@([a-zA-Z0-9-]+.)+[a-zA-Z]+$/";
            if(!preg_match($patron, $tmp_correo)) {
                $err_correo = "El correo tiene un formato incorrecto";
            } else {
                $palabras_baneadas = ["caca","peo","recorcholis","caracoles","repampanos"];
                
                foreach($palabras_baneadas as $palabra_baneada){
                    $palabras_encontradas = "";
                    if(str_contains($tmp_correo,$palabra_baneada)){
                        $palabras_encontradas = "$palabra_baneada, " . $palabras_encontradas;
                    }
                    if($palabras_encontradas != '') {
                        $err_correo = "No se permiten las palabras: $palabras_encontradas";
                    } else {
                        $correo = $tmp_correo;
                    }
                }
            }
        }

        //VALIDACION DE DATOS DEL USUARIO
        if($tmp_usuario == ''){
            $err_usuario = "El usuario es obligatorio";
        } else {
            // letras de la A a la Z (MAYUS O MINUS) y barrabaja
            $patron = "/^[a-zA-Z0-9_]{4,12}$/";
            if(!preg_match($patron, $tmp_usuario)) {
                $err_usuario = "El usuaruo debe contener de 4 a 12 letras,
                numeros o barrabaja";
            } else {
                $usuaruo = $tmp_usuario;
            }
        }

        //VALIDACION DE DATOS DEL NOMBRE
        if($tmp_nombre == ''){
            $err_nombre = "El nombre es obligatorio";
        } else {
            if(strlen($tmp_nombre) < 2  || strlen($tmp_nombre) > 40){
                $err_nombre = "El nombre debe tener entre 2 y 40 caracteres";
            } else {
                //letras, espacios en blanco y tildes
                $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/";
                if(!preg_match($patron, $tmp_nombre)){
                    $err_nombre = "EL nombre solo puede contener letras y espacios en blanco";
                } else {
                    $nombre= $tmp_nombre;
                }
            }
        }

        //VALIDACION DE DATOS DEL APELLIDO
        if($tmp_apellido == ''){
            $err_apellido = "El apellido es obligatorio";
        } else {
            if(strlen($tmp_apellido) < 2  || strlen($tmp_apellido) > 60){
                $err_apellido = "El nombre debe tener entre 2 y 60 caracteres";
            } else {
                //letras, espacios en blanco y tildes
                $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ]+$/";
                if(!preg_match($patron, $tmp_apellido)){
                    $err_apellido = "EL nombre solo puede contener letras y espacios en blanco";
                } else {
                    $apellido= $tmp_apellido;
                }
            }
        }

        //VALIDACION DE DATOS de mayoria de edad
        if($tmp_fecha_nacimiento == ''){
            $err_fecha_nacimiento = "La fecha de nacimiento es obligatoria";
        } else {
            $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
            if(!preg_match($patron, $tmp_fecha_nacimiento)){
                $err_fecha_nacimiento = "formato mde fecha incorrecto";
            } else {
                $fecha_actual = date("Y-m-d");
                list($anno_actual, $mes_actual,$dia_actual) = explode ('-', $fecha_actual); //creo un array y lo decompongo con list en tres variables
                list($anno,$mes,$dia) = explode('-',$tmp_fecha_nacimiento);
            
                if($anno_actual - $anno < 18) {
                    $err_fecha_nacimiento = "El usuaruo es menor de edad";
                } elseif($anno_actual - $anno == 18) {
                    if($mes_actual - $mes < 0) {
                        $err_fecha_nacimiento = "El usuaruo es menor de edad";
                    } elseif($mes_actual - $mes == 0){
                        if($dia_actual < $dia) {
                            $err_fecha_nacimiento = "El usuaruo es menor de edad";
                        } else {
                            $fecha_nacimiento = $tmp_fecha_nacimiento;
                        }
                    } elseif($mes_actual - $mes > 0){
                        $fecha_nacimiento = $tmp_fecha_nacimiento;
                    }
                } elseif($anno_actual - $anno > 121) {
                    $err_fecha_nacimiento = "No puedes tener mas de 120 años";
                } elseif ($anno_actual - $anno == 121) {}
            }
        }
    }

    ?>
    
    <!--CREACION DEL FORMULARIO-->
    <form class="col-10" action="" method="post">
        <div class="mb-3">
            <label class="form-label">DNI</label>
            <input class="form-control" type="text" name="dni">
            <?php if(isset($err_dni)) echo "<span class='error'> $err_dni</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Correo Electrónico</label>
            <input class="form-control" type="text" name="correo">
            <?php if(isset($err_correo)) echo "<span class='error'> $err_correo</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input class="form-control" type="text" name="usuario">
            <?php if(isset($err_usuario)) echo "<span class='error'> $err_usuario</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input class="form-control" type="text" name="nombre">
            <?php if(isset($err_nombre)) echo "<span class='error'> $err_nombre</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Apellido</label>
            <input class="form-control" type="text" name="apellido">
            <?php if(isset($err_apellido)) echo "<span class='error'> $err_apellido</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de nacimiento</label>
            <input class="form-control" type="date" name="fecha_nacimiento">
            <?php if(isset($err_fecha_nacimiento)) echo "<span class='error'> $err_fecha_nacimiento</span>"?>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de primer DNI</label>
            <input class="form-control" type="date" name="fecha_primer_dni">
            <?php if(isset($err_fecha_primer_dni)) echo "<span class='error'> $err_fecha_nacimiento</span>"?>
        </div>
        <div class="mb-3">
            <input type="submit" class="btn btn-primary" value="Enviar">
        </div>
        
    </form>

    <!--SI TODO ES CORRECTO SE CREA ESTA ESTRUCTURA PARA COMPROBARLO Y ENVIARLO A LA BASE DE DATOS-->
    <?php
        if(isset($dni) && isset($correo) && isset($usuario) && isset($nombre)){ ?>
            <h1><?php echo $dni ?></h1>
            <h1><?php echo $correo ?></h1>
            <h1><?php echo $usuario ?></h1>
            <h1><?php echo $nombre ?></h1>
    <?php } ?>
    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>