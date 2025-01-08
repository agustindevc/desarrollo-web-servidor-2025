<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    

        require('../05_funciones/potencias.php');
    ?>
</head>
<body>
    <!--
    /**
     * CREAR UN FORMULARIO QUE RECIBA DOS PARAMETROS: BASE Y EXPONENTE
    * CUANDO SE ENVIE EL FORMULARIO SE CALCULARA EL RESULTADO DE ELEVAR LA BASE AL EXPONENTE
    *   EJEMPLOS:
    *2 ELEVADO A 3 = 8 => 2X2X2 = 8
    *3 ELEVADO A 2 = 9 => 3X3X3 =9
    *2 ELEVADO A 1 = 2
    *3 ELEVADO A 0=1
    */
    -->

    <form action="" method="post">
        <label for="base">Base</label> <!--Se puede usar placeholder en lugar de lablel-->
        <input type="text" name="base" id="base" placeholder="Base">
        <label for="exponente">Exponente</label>
        <input type="text" name="exponente" id="exponente">
        <input type="submit" value="Enviar">
    </form>

    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_base = $_POST["base"];
            $tmp_exponente = $_POST["exponente"];

            //funcion con validacion de datos de base
            if($tmp_base != ''){
                if(filter_var($tmp_base, FILTER_VALIDATE_INT) !== FALSE){
                    $base = $tmp_base;
                }else {
                    echo "<p>La base debe ser un numero</p>";
                }
            } else {
                echo "<p>La base es obligatoria</p>";
            }

            //funcion con validacion de datos de exponente
            if($tmp_exponente == '') {
                echo "<p>El exponente es obligatorio</p>";
            } else {
                if(filter_var($tmp_exponente, FILTER_VALIDATE_INT) === FALSE) {
                    echo "<p>El exponente debe ser un número</p>";
                } else {
                    if($tmp_exponente < 0) {
                        echo "<p>El exponente debe ser mayor o igual que cero</p>";
                    } else {
                        $exponente = $tmp_exponente;
                    }
                }
            }

            //compruebo si en este punto las variables ya existen o no con  isset
            $resultado;
            if(isset($base) && isset($exponente)){
                $resultado = potencia($base, $exponente);
                echo "<h1>El resultado es $resultado</h1>";
            }
        }
    ?>
    
</body>
</html>