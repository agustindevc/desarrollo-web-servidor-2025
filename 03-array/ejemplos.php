<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    /**
     * TODOS LOS ARRAYS EN PHP SON ASOCIATIVOS, COMO LOS MAP DE JAVA
     * 
     * TIENEN PARES CLAVE-VALOR
     */

     $numeros = [5,10,9,6,7,4];
     $numeros = array(6,10,9,4,3);
     print_r($numeros); #PRINT RELATIONAL

    echo "<br><br>";

    $animales = ["Perro", "Gato", "Ornitorrinco", "Suricato", "Capibara"];
    $animales= [
        "A01" => "Perro",
        "A02" => "Gato",
        "A03" => "Ornitorrinco",
        "A04" => "Suricato",
        "A05" => "Capibara",
    ];
    print_r($animales);
    
    echo "<p>" . $animales ["A03"] . "</p>";

    $animales[2] = "Koala";
    $animales[6] = "Iguana";
    $animales ["A01"] = "Elefante"; /*Añande el elemento al final de array con su clave*/
    array_push($animales, "Morsa","Foca"); /*Array push añade varios elementos sin las claves.*/
    $animales[] = "Ganso"; /*Añade el elemento al final del array, sin clave. Se usa para elementos idnexador (nuimericamente)*/
    unset($animales["A02"]); /*Elimina el elemento QUE TENGA ESA CLAVE, O SI ES SIN CLAVE, DE LA UBICACION QUE SE LE INDIQUE ENTRE PARENTESIS*/

    $animales = array_values($animales); /*se carga las claves y reordena el array numericamente*/

    //RECORRER ARRAY con FOR
    echo "<ol>";
    for($i = 0; $i < count($animales); $i++){
        echo "<li>" . $animales[$i] . "</li>";
    }
    echo "</ol>";

    //RECORRER ARRAY con WHILE
    $j = 0;
    echo "<ol>";
    while($j<count($animales)){
        echo "<li>" . $animales[$j] . "</li>";
        $j++;
    }
    echo "</ol>";

    //BUCLES FOR EACH (recorre el por sus claves array y muestra sus valores)
    echo"<ol>";
    foreach($coches as $coche){
        echo"<li>$coche</li>";
    }
    echo "</ol>";

    //PARA MOSTRAR LA CLAVE Y EL VALOR UTILIZANDO FOR EACH
    echo"<ol>";
    foreach($coches as $matricula => $coche){
        echo"<li>$coche</li>";
    }
    echo "</ol>";

    $cantidad_animales = count($animales); /*Cuenta la cantidad de objetos que hay en el array.*/

    echo "<h3>Hay $cantidad_animales animales</h3>";

    //print_r($animales);


    //EJERCICIO CON ARRAY DE COCHE

    /**
     *      "4312 TDZ" => "Audi TT"
     *      "1122 FFF" => "Mercedes CLR"
     *      
     *      CREAR EL ARRAY CON 3 COCHES
     *      AÑADIR 2 COCHES CON SUS MATRICULAS
     *      AÑADIR 1 COCHE SIN MATRICULA
     *      BORRAR EL COCHE SIN MATRICULA
     *      RESETEAR EL COCHE SIN MATRICULA
     */

        /*Crear el array con 3 coches*/
            $coches = [
                "4312 TDZ" => "Audi TT",
                "1122 FFF" => "Mercedes",
                "1567 YMK" => "BMW", 
            ];

        /*AÑADIR 2 COCHES CON SUS MATRICULAS*/ 
            $coches ["YSU 6734"] = "Seat Ibiza";
            $coches ["RMS 9045"] = "Fiat Multipla";


        /*AÑADIR 1 COCHE SIN MATRICULA*/
            array_push($coches, "Peugeot 206");

            //print_r($coches); //Muestra por consola

        /*BORRAR EL COCHE SIN MATRICULA*/
            unset($coches [0]); /*Se utiliza el 0 porque lo isnertara en el primer espacio libre y ese es el 0*/

            
        /*RESETEAR EL COCHE SIN MATRICULA*/

        $coches22 = array_values($coches);

        //print_r($coches); //Muestra por consola    
    ?>

        <!--CREACION DE TABLA CON FOR EACH EN HTML PHP-->
    <table>
        <caption>Coches</caption>
            <thead>
                <tr>
                    <th>Matrícula</th>
                    <th>Coche</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($coches as $matricula => $coche){
                        echo"<tr>";
                            echo"<td>$matricula</td>";
                            echo"<td>$coche</td>";
                        echo"</tr>";
                    }
                ?>
            </tbody>
    </table>

    
</body>
</html>