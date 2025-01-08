<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );    

        require('../05_funciones/calculadora_irpf.php');
    ?>
</head>
<body>
    <form action="" method="post">
        <input type="text" name="salario" placeholder="Salario">
        <input type="submit" value="Calcular salario bruto">
    </form>
    <?php
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $tmp_salario = $_POST["salario"]; //recojo los datos del fomulario y lo asigno en una variable "temporal"

        //validacion de datos
        if($tmp_salario == '') {
                echo "<p>El salario es obligatorio</p>";
            } else {
                if(filter_var($tmp_salario, FILTER_VALIDATE_FLOAT) === FALSE) { //Filtro para validar si el dato introducido en salario es correctoFLOAT porque puede contener decimales
                    echo "<p>El salario debe ser un número</p>";
                } else {
                    if($tmp_salario < 0) {
                        echo "<p>El salario debe ser mayor o igual que cero</p>";
                    } else {
                        $salario = $tmp_salario;
                    }
                }
            }

            //compruebo si en este punto las variables ya existen o no con  isset
            $salarioBruto; //declaro variable para mostrar el resultado
            if(isset($salario)){ //si la variable salario existe en este punto...
                $salarioBruto = CalcularIRPF($salario); //lamada a la funcion
                echo "<h1>El salario bruto es $salarioBruto</h1>";
            }
    }
    ?>
</body>
</html>