<?php 
session_start(); 

if ($_SESSION["rol_cliente"]!="clientes") {
    header("Location:../iniciar_sesion.php");
}

include_once '../funciones/conexion.php';
include_once '../funciones/servicios/servicios_eliminar.php';
include_once '../funciones/servicios/servicios_consultar.php';

$id_cliente = $_SESSION["id_cliente"];
$fecha = date('Y-m-d');
$hora = date('H:i:s');
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
                                <img src='../{$servicio['imagen']}' alt='{$servicio['nombre']}'>
                            </figure>
                        </div>
                        <div class='tarjeta-info-275'>    
                            <h3 class='tarjeta-titulo'>{$servicio['nombre']}</h3>
                            <p class='tarjeta-texto'>{$servicio['detalle']}</p>
                            <p class='precio'>S/.{$servicio['precio']}</p>
                            <form action='cotizacion.php' method='post'>
                                <input type='hidden' name='id_cliente' value='{$id_cliente}'>
                                <input type='hidden' name='id_servicio' value='{$servicio['id_servicio']}'>
                                <input type='hidden' name='nombre_servicio' value='{$servicio['nombre']}'>
                                <input type='hidden' name='detalle_servicio' value='{$servicio['detalle']}'>
                                <input type='hidden' name='precio' value='{$servicio['precio']}'>
                                <input type='hidden' name='funcion' value='insertar_lista'>
                                <button type='submit' class='btn comprar-btn'>
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