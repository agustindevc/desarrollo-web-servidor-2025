<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRACTICA DE MUCHOS FORMULARIOS</title>
    <!--En este fchero colocar todos ,los formuilarios que hechos hecho y hacerlos con funciones-->
    
    <?php
        error_reporting( E_ALL );
        ini_set( "display_errors", 1 );
        require('../05_funciones/potencias.php')//completar!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    ?>
</head>
<body>
    
</body>
</html><!--En este fchero colocar todos ,los formuilarios que hechos hecho y hacerlos con funciones-->

<!--Formulario potencias-->
<form action="" method="post">
    <label for="base">Base</label> <!--Se puede usar placeholder en lugar de lablel-->
    <input type="text" name="base" id="base" placeholder="Base">
    <label for="exponente">Exponente</label>
    <input type="text" name="exponente" id="exponente">
    <input type="hidden" name="accion" value="formulario_potencias">
    <input type="submit" value="Enviar">
</form>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if($_POST["accion"] == "formulario_potencias"){
            $base = $_POST["base"];
            $exponente = $_POST["exponente"];
            
            calcularPotencias($base, $exponente);
        }
    }
?>

<!--Formulario IVA-->

<form action="" method="post">
        <label for="precio">Precio</label>
        <input type="text" name="precio" id="precio">
        <br><br>
        <select name="iva">
            <option value="general">General</option>
            <option value="reducido">Reducido</option>
            <option value="superreducido">Superreducido</option>
        </select>
        <br><br>
        <input type="hidden" name="accion" value="formulario_iva">
        <input type="submit" value="Calcular">
    

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if($_POST["accion"] == "formulario_iva"){
            $precio = $_POST["precio"];
            $iva = $_POST["iva"];

            calcularIva($precio, $iva);
        }
    }
?>

<!--Formulario multiplicar-->
<form action="" method="post"> <!--Si algo es incorrecto aqui, el fomulario se envia por GET-->
    <label for="Numero">Numero</label>     
    <input type="text" name="Numero" id="Numero"> 
    <input type="hidden" name="accion" value="formulario_multiplicar">
    <input type="submit" value="Enviar"> 
</form>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if($_POST["accion"] == "formulario_multiplicar"){
            $num = $_POST["Numero"];

            Multiplicar($num);
        }
    }
?>