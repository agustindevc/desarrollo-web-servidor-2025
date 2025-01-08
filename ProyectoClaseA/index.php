<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal del administrador</title>
    <link rel="stylesheet" href="./estilos_principal.css">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('./util/conexion.php');


        
    ?>
</head>
<body>
    <?php
        /*session_start();
        if(isset($_SESSION["usuario"])) {
            echo "<h2>Bienvenid@ " . $_SESSION["usuario"] . "</h2>";
            */?>
            
        
            <div class="content__cards">
                <div class="cards__card">
                    <p class="card__icon"><img class="card__img card__sello" src="./img/sello.png"></p>
                    <h2 class="card__category">Revendedores</h2>
                </div>
                <div class="cards__card">
                    <p class="card__icon"><img class="card__img card__caja" src="./img/caja.png"></p>
                    <h2 class="card__category">Proveedores</h2>
                </div>
                <div class="cards__card">
                    <p class="card__icon"><img class="card__img card__servicioimg" src="./img/servicios.png"></p>
                    <div class="form__division">
                        <a class="btn_registro_revendedor" href="./productos/index.php">Productos</a>
                    </div>
                </div>
            </div>

    <footer>
        <p>Desarrollado por Agustín Diaz - Todos los derechos reservados - &reg; Clase A Argentina.</p>
    </footer>
        
</body>
</html>


