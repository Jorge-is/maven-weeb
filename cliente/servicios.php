<?php
include_once '../funciones/conexion.php';
sesion_segura();
if (!isset($_SESSION["rol_cliente"]) || $_SESSION["rol_cliente"] !== "clientes") {
    header("Location: ../iniciar_sesion.php");
    exit();
}
include_once '../funciones/servicios/servicios_consultar.php';

$id_cliente = (int)$_SESSION["id_cliente"];
$fecha      = date('Y-m-d');
$hora       = date('H:i:s');
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
            <div class="tarjetas-grid">
            <?php foreach ($servicios as $servicio): ?>
                <div class="tarjeta">
                    <div>
                        <figure>
                            <img src="../<?php echo e($servicio['imagen']); ?>" alt="<?php echo e($servicio['nombre']); ?>">
                        </figure>
                    </div>
                    <div class="tarjeta-info-275">
                        <h3 class="tarjeta-titulo"><?php echo e($servicio['nombre']); ?></h3>
                        <p class="tarjeta-texto"><?php echo e($servicio['detalle']); ?></p>
                        <p class="precio">S/.<?php echo e($servicio['precio']); ?></p>
                        <form action="cotizacion.php" method="post">
                            <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="id_cliente"       value="<?php echo $id_cliente; ?>">
                            <input type="hidden" name="id_servicio"      value="<?php echo (int)$servicio['id_servicio']; ?>">
                            <input type="hidden" name="nombre_servicio"  value="<?php echo e($servicio['nombre']); ?>">
                            <input type="hidden" name="detalle_servicio" value="<?php echo e($servicio['detalle']); ?>">
                            <input type="hidden" name="precio"           value="<?php echo e($servicio['precio']); ?>">
                            <input type="hidden" name="funcion"          value="insertar_lista">
                            <button type="submit" class="btn comprar-btn">
                                <i class="fas fa-cart-shopping"></i> Solicitar servicio
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </main>
    <?php require_once './fragments/footer.php'; ?>
</body>
</html>
