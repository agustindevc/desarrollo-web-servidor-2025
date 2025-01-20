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
            manejarPut($_conexion, $entrada); //UPDATE EN LA QUERY
            break;
        case "DELETE":
            manejarDelete($_conexion, $entrada);
            break;
        default:
        echo json_encode(["metodo" => "otro"]);
            break;
    }

    function manejarGet($_conexion) {
        if(isset($_GET["ciudad"]) && isset($_GET["anno_fundacion"])) {
            $sql = "SELECT * FROM estudios WHERE ciudad = :ciudad AND anno_fundacion = :anno_fundacion";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "ciudad" => $_GET["ciudad"],
                "anno_fundacion" => $_GET["anno_fundacion"]
            ]);
        } elseif(isset($_GET["anno_fundacion"])) {
            $sql = "SELECT * FROM estudios WHERE anno_fundacion = :anno_fundacion";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "anno_fundacion" => $_GET["anno_fundacion"]
            ]);
        } elseif(isset($_GET["ciudad"])) {
            $sql = "SELECT * FROM estudios WHERE ciudad = :ciudad";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute([
                "ciudad" => $_GET["ciudad"]
            ]);
        } else {
            $sql = "SELECT * FROM estudios";
            $stmt = $_conexion -> prepare($sql);
            $stmt -> execute();
        }  
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

    function manejarDelete($_conexion, $entrada){
        $sql = "DELETE FROM estudios WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "nombre_estudio" => $entrada["nombre_estudio"]
        ]);

        if($stmt) {
            echo json_encode(["mensaje" => "El estudio se ha borrado correctamente"]);
        } else {
            echo json_encode(["mensaje" => "error al borrar la consola"]);
        }  
    }

    function manejarPut($_conexion, $entrada){
        $sql = "UPDATE estudios set ciudad = :ciudad, anno_fundacion = :anno_fundacion
        WHERE nombre_estudio = :nombre_estudio";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "ciudad" => $entrada["ciudad"],
            "anno_fundacion" => $entrada["anno_fundacion"],
            "nombre_estudio" => $entrada["nombre_estudio"]
        ]);

        if($stmt) {
            echo json_encode(["mensaje" => "El estudio se ha modificado correctamente"]);
        } else {
            echo json_encode(["mensaje" => "error al modificar la el estudio"]);
        }
    }
?>