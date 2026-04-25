<?php
include_once 'funciones/conexion.php';
include_once 'funciones/servicios/servicios_consultar.php';
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <title>Servicios</title>
    <?php require_once './fragments/links.php'; ?>
</head>

<body>
    <?php require_once './fragments/header.php'; ?>
    <main>
        <div class="container flex-center">
            <h1 class="titulo-1">Servicios</h1>
            <?php
            foreach ($servicios as $servicio) {
                echo "<div class='tarjeta'>
                        <div>
                            <figure>
                                <img src='{$servicio['imagen']}' alt='{$servicio['nombre']}'>
                            </figure>
                        </div>
                        <div class='tarjeta-info-275'>    
                            <h3 class='tarjeta-titulo'>{$servicio['nombre']}</h3>
                            <p class='tarjeta-texto'>{$servicio['detalle']}</p>
                            <p class='precio'>S/.{$servicio['precio']}</p>
                            <form action='iniciar_sesion.php'>
                                <input type='hidden' name='servicio' value='{$servicio['nombre']}'>
                                <button type='' class='btn comprar-btn'>
                                    <i class='fas fa-cart-shopping'></i> Solicitar servicio
                                </button>
                            </form>
                        </div>
                    </div>";
                }
            ?>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>

</html>