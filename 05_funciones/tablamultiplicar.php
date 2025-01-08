<?php
    function Multiplicar($num){
?>
<table>
    <?php
              
        for($i = 1; $i <= 10; $i++){
            $resultado = $num * $i;
    
            echo"<tr>";
                echo"<td>$num</td>";
                echo"<td>X</td>";
                echo"<td>$i<td>";
                echo"<td>=<td>";
                echo"<td>$resultado</td>";
            echo"</tr>";

        }
    }
    ?>
</table>