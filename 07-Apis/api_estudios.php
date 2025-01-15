<?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );  

    header("Content-Type: application/json"); //esta linea devolvera un Json.
    include("conexion_pdo.php");

    $metodo = $_SERVER["REQUEST_METHOD"]; //Tomamos el metodo con el que se esta haciendo la peticion.
    $entrada = json_decode(file_get_contents('php://input'), true); //almacena en $entrada un array asociativo con los datos. Decodifica el JSon y lo pone en php.

    //segun el metodo, se ejecutara una funcion determinada
    switch($metodo) {
        case "GET":
            //echo json_encode(["metodo" => "get"]);
            manejarGet($_conexion);
            break;
        case "POST":
            manejarPost($_conexion, $entrada);
            break;
        case "PUT":
            echo json_encode(["metodo" => "put"]);
            break;
        case "DELETE":
            echo json_encode(["metodo" => "delete"]);
            break;
        default:
        echo json_encode(["metodo" => "otro"]);
            break;
    }

    function manejarGet($_conexion) {
        $sql = "SELECT * FROM estudios";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);  #Equivalente al get_result de Mysqlli
        echo json_encode($resultado); //Codifica en JSon el resultado
    }

    function manejarPost($_conexion, $entrada) {
        $sql = "INSERT INTO estudios (nombre_estudio, ciudad, anno_fundacion)
            VALUES (:nombre_estudio, :ciudad, :anno_fundacion)";

        $stmt = $_conexion -> prepare($sql);

        //Se insertan los datos en la BD. Los datos vienen del formulario.
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"],
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"]
        ]);
        if($stmt) {
            echo json_encode(["mensaje" => "el estudio se ha insertado correctamente"]);
        } else {
            echo json_encode(["mensaje" => "error al insertar el estudio"]);
        }     
    }
?>