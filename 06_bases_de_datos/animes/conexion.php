<?php
    $_servidor = "127.0.0.1"; //localhost

    $_usuario = "estudiante";
    $_contraseña = "estudiante";
    $_base_de_datos = "animes_bd";

    //Mysqlu o PDO

    //creo la conecion instamnciando el objeto Myssqlu con los datos como parametros.
    //establece la conexion o muere.
    $_conexion = new Mysqli($_servidor,$_usuario,$_contraseña,$_base_de_datos)
        or die("Error de conexion");
        
?>