<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de usuarios trabajado por Agustin para practicar</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  
    ?>
</head>
<body>
    <div class="Container">

       
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $tmp_dni = $_POST["dni"];
            $tmp_correo = $_POST["correo"];
            $tmp_nombre_usuario = $_POST["nombre_usuario"];
            $tmp_nombre = $_POST["nombre"];
            $tmp_fecha_nacimiento = $_POST["fecha_nacimiento"];
        
            /*VALIDACION DE DATOS DEL DNI (8 DIGITOS Y UNA LETRA. LA LETRA DEBE 
        COINCIDIR CON EL CALCULO DE LA LETRA DEL DNI EN ESPAÑA)*/
            if($tmp_dni == ''){
                $err_dni = "El DNI es obligatorio";
            } else {
                $tmp_dni = strtoupper($tmp_dni); //convierto la cadena en mayusculas por si el usuario la ingreso en minusculas.
                $patron = "/^[0-9]{8}[A-Z]$/";
                if(!preg_match($patron, $tmp_dni)){ //funcion que compara si $tmp_dni conicide con el patron indicado en $patron.
                    //si no coincide ingresa en el bucle.
                    $err_dni = "El DNI debe tener 8 numeros y una letra";
                } else{
                    $numero_dni = (int)substr($tmp_dni,0,8); //divido el dni desde el digito 0 al 8 y lo guardo en la variable $numero_dni.
                    $letra_dni = substr($tmp_dni,8,1); //divido el dni desde el digito 8 al 9 (la letra) y lo guardo en la variable %letra_dni.
                    
                    $resto_dni = $numero_dni % 23; //aplico la formula para obtener el resto de dividir el DNI por 23

                    //asigno mediante match una letra al dni segun la formulo, y la guardo en la variable $letra_correcta
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

                    //si la letra asignada en $letra_correcta, coincide con la letra ingresada en el DNI, sinifica que la letra es correcta
                    if($letra_correcta != $letra_dni){
                        $err_dni = "La letra del dni no es correcta"; //si la letra no es correcta, meustro el mensaje
                    } else { //si la letra es correcta, la asigno en la variable permanente para enviar al servidor
                        $dni = $tmp_dni;
                    }
                }
            }

            //VALIDACION DE CORREO
            if($tmp_correo == ""){
                $err_correo = "El correo electronico es obligatorio.";
            } else {
                $patron = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
                if(!preg_match($patron, $tmp_correo)){
                    $err_correo = "El correo tiene un formato incorrecto.";
                } else { 
                    $palabras_baneadas = ["caca","peo","recorcholis","caracoles","repampanos"];
                    
                    $palabras_encontradas = ""; //esta variable almacenara las palabras baneadas que se encuentren en el correo ingresado por el usuario.
                    foreach($palabras_baneadas as $palabra_baneada){
                        if(str_contains($tmp_correo,$palabra_baneada)) { //si $tmp_correo contiene la palabra baneada... (devuelve true o false).
                            $palabras_encontradas = "$palabra_baneada, " . $palabras_encontradas; //añado al string de $palabras_encontradas, la $palabra_baneada.                            
                            
                        }
                        if($palabras_encontradas != ""){
                            $err_correo = "El correo no puede contener las siguientes palabras: ". $palabras_encontradas;
                        }
                        else {
                            $correo = $tmp_correo;    
                        }
                    }
                }    
            }

            //VALIDACION DE NOMBRE DE USUARIO
            if($tmp_nombre_usuario == ""){
                $err_nombre_usuario = "El nombre de usuario es obligatorio.";
            } else {
                $patron = "/^[a-zA-Z0-9_]{4,12}$/"; //entre 4 y 12 caracteres, solo permitiendo letras, números y BARRABAJA.
                if(!preg_match($patron,$tmp_nombre_usuario)){
                    $err_nombre_usuario = "El formato de nombre de usuario es incorrecto";
                } else {
                    $nombre_usuario = $tmp_nombre_usuario;
                }
            }

            //VALIDACION DE NOMBRE
           /*Nombre (Campo obligatorio): Debe contener entre 2 y 40 caracteres,
            permitiendo solo letras y espacios en blanco, incluyendo caracteres
             acentuados.*/
             if($tmp_nombre == ""){
                $err_nombre = "El nombre de usuario es obligatorio.";
             } else {
                $patron = "/^[a-zA-ZÁÉÍÓÚáéíóúüÜñÑ ]{2,40}$/";
                if(!preg_match($patron, $tmp_nombre)){
                    $err_nombre = "El formato el nombre es incorrecto";
                } else {
                    $nombre = $tmp_nombre;
                }
             }

             /*VALIDACION DE FECHA DE NACIMIENTO
             Verifica que el usuario sea mayor de edad.
             Utiliza el formato de fecha YYYY-MM-DD.*/
             if($tmp_fecha_nacimiento == ""){
                $err_fecha_nacimiento = "La fecha de nacimiento es obligatoria";
             } else {
                $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                if(!preg_match($patron,$tmp_fecha_nacimiento)){
                    "El formato de fehca no es valido";
                }
                else{
                    $fecha_actual = date("Y-m-d"); //Guardo la fecha actual en la variable, con el formato YYY-mm-dd.
                    //descomposicion de la fecha en variables para año, mes y dia usando explode
                    list($anno_actual,$mes_actual,$dia_actual) = explode('-', $fecha_actual);
                    list($anno,$mes,$dia) = explode('-', $tmp_fecha_nacimiento);

                    if($anno_actual-$anno < 18){
                        $err_fecha_nacimiento = "El usuario es menor de edad.";
                    } else if($anno_actual-$anno == 18) {
                        if($mes_actual-$mes < 0){
                            $err_fecha_nacimiento = "El usuario es menor de edad.";
                        } elseif ($mes_actual-$mes == 0){
                            if($dia_actual-$dia < 0){
                                $err_fecha_nacimiento = "El usuario es menor de edad.";
                            }
                            else{
                                $fecha_nacimiento = $tmp_fecha_nacimiento;
                            }
                        }
                    }
                }
            }


             /*if($tmp_fecha_nacimiento == ""){
                $err_fecha_nacimiento = "La fecha de nacimiento es obligatoria."; 
             } else {
                if((date('Y') - 18) < (int)(substr($tmp_fecha_nacimiento,6,10))){
                    $err_fecha_nacimiento = "El usuario es menor de edad";
                } elseif((date('Y') - 18) == (int)(substr($tmp_fecha_nacimiento,5,4))){
                    if(date('M') < (int)(substr($tmp_fecha_nacimiento,2,2))){
                        $err_fecha_nacimiento = "El usuario es menor de edad";
                    } elseif(date('m') == (int)(substr($tmp_fecha_nacimiento,2,2))){
                        if(date('d') < (int)(substr($tmp_fecha_nacimiento,0,2))){
                            $err_fecha_nacimiento = "El usuario es menor de edad";
                        }else{
                            $fecha_nacimiento = $tmp_fecha_nacimiento;
                        }
                    }
                }
            }*/
        }
        
        ?>

        <form action="" method="post">
            <div>
                <label for="dni">DNI</label>
                <input type="text" name="dni" id="dni">
                <?php if(isset($err_dni)) echo "<h1>$err_dni</h1>"?>
            </div>
            <div>
                <label for="correo">Correo Electronico</label>
                <input type="text" name="correo" id="correo">
                <?php if(isset($err_correo)) echo "<h1>$err_correo</h1>"?>
            </div>
            <div>
                <label for="nombre_usuario">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario">
                <?php if(isset($err_nombre_usuario)) echo "<h1>$err_nombre_usuario</h1>"?>
            </div>
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre">
                <?php if(isset($err_nombre)) echo "<h1>$err_nombre</h1>"?>
            </div>
            <div>
                <label for="fecha_nacimiento">Fecha de nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento">
                <?php if(isset($err_fecha_nacimiento)) echo "<h1>$err_fecha_nacimiento</h1>"?>
            </div>
            <div>
                <input type="submit" value="Enviar">
            </div>
        </form>

        <?php
        //DATOS PARA ENVIAR AL SERVIDOR
        if(isset($dni) && isset($correo) && isset($nombre_usuario) && isset($nombre) && isset($fecha_nacimiento)){ ?>
            <h1><?php echo $dni ?> </h1>
            <h1><?php echo $correo ?> </h1>
            <h1><?php echo $nombre_usuario ?> </h1>
            <h1><?php echo $nombre ?> </h1>
            <h1><?php echo $fecha_nacimiento ?> </h1>



        <?php } ?>

    </div>
</body>
</html>